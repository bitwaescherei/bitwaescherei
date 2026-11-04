#!/usr/bin/env bash
# Build & run the site in a container, then smoke-test the endpoints.
# The container is removed at the end. Output goes to stdout and,
# unless running in CI, also to verify.log.
#
# Environment:
#   IMAGE   test this already built image instead of building one
#   ENGINE  container engine to use: podman (default) or docker
#   PORT    host port to publish the site on (default 8080)
set -u
cd "$(dirname "$0")/.."
[ -n "${CI:-}" ] || exec > >(tee verify.log) 2>&1

NAME=bitwaescherei-verify
ENGINE=${ENGINE:-podman}
IMAGE=${IMAGE:-}
PORT=${PORT:-8080}
BASE="http://localhost:$PORT"
TMP=$(mktemp -d)
trap 'rm -rf "$TMP"; $ENGINE rm -f -v "$NAME" >/dev/null 2>&1' EXIT

PASS=0 FAIL=0 WARN=0
pass() { PASS=$((PASS+1)); echo "  PASS  $*"; }
fail() { FAIL=$((FAIL+1)); echo "  FAIL  $*"; }
warn() { WARN=$((WARN+1)); echo "  WARN  $*"; }

for tool in "$ENGINE" curl; do
	command -v "$tool" >/dev/null || { echo "missing tool: $tool"; exit 2; }
done
if [ ! -f config/.env ]; then
	echo "== creating config/.env with a random ADMINPASSWORD"
	echo "ADMINPASSWORD=$(tr -dc 'A-Za-z0-9' </dev/urandom | head -c 32)" > config/.env
fi

echo "== $(date -Is) on $(git rev-parse --abbrev-ref HEAD)@$(git rev-parse --short HEAD)"

if [ -z "$IMAGE" ]; then
	IMAGE=bitwaescherei:verify
	echo "== build"
	$ENGINE build $([ "$ENGINE" = podman ] && echo --format docker) --build-arg VERSION=verify --tag "$IMAGE" --file config/Containerfile . \
		|| { echo "build failed"; exit 1; }
fi

echo "== (re)start container $NAME from $IMAGE on port $PORT"
$ENGINE rm -f -v "$NAME" >/dev/null 2>&1
# no mount on /var/www/config: the engine creates an anonymous volume from the
# image's directory, owned by the PHP user, just like the README suggests
$ENGINE run -d --name "$NAME" -p "$PORT:8080" \
	-v "$PWD/config/.env:/var/www/config/.env:ro$([ "$ENGINE" = podman ] && echo ,Z)" \
	"$IMAGE" || { echo "run failed"; exit 1; }

echo "== wait for readiness"
for i in $(seq 1 30); do
	curl -fs -o /dev/null "$BASE/" && break
	sleep 1
done
curl -fs -o /dev/null "$BASE/" || { echo "not ready after 30s"; $ENGINE logs "$NAME"; exit 1; }

# fetch PATH -> sets CODE, LOC, and body in $TMP/body
fetch() {
	read -r CODE LOC < <(curl -s -D "$TMP/headers" -o "$TMP/body" -w '%{http_code} %{redirect_url}\n' "$BASE$1")
}
no_cookie() { grep -qi '^set-cookie:' "$TMP/headers" && fail "$1 sets a cookie" || pass "$1 sets no cookie"; }
expect_status() { # path code
	fetch "$1"
	[ "$CODE" = "$2" ] && pass "$1 -> $CODE" || fail "$1 -> $CODE (expected $2)"
}
expect_redirect() { # path location-suffix
	fetch "$1"
	if [ "$CODE" = 301 ] && [ "$LOC" = "$BASE$2" ]; then
		pass "$1 -> 301 $2"
	else
		fail "$1 -> $CODE ${LOC:-<no location>} (expected 301 $2)"
	fi
}
has()    { grep -Eq -- "$2" "$TMP/body" && pass "$1 contains $2" || fail "$1 lacks $2"; }
hasnt()  { grep -Eq -- "$2" "$TMP/body" && warn "$1 contains $2" || pass "$1 has no $2"; }
maybe()  { grep -Eq -- "$2" "$TMP/body" && pass "$1 contains $2" || warn "$1 lacks $2 (may be date dependent)"; }

echo "== German home page"
expect_status / 200
no_cookie /
cp "$TMP/body" "$TMP/de.html"
has / 'lang="de'
has / 'href="/en/"'
has / 'data-src="/event-cards.php\?lang=de"'
has / 'Unser Leitbild'
hasnt / '>Charter<'
hasnt / '<\?php|Warning:|Notice:|Deprecated:'
expect_redirect /index.php /

echo "== English home page"
expect_redirect /en /en/
expect_status /en/ 200
cp "$TMP/body" "$TMP/en.html"
has /en/ 'lang="en"'
has /en/ 'href="/"'
has /en/ 'data-src="/event-cards.php\?lang=en"'
has /en/ '>Charter<'
hasnt /en/ 'Unser Leitbild'
hasnt /en/ '<\?php|Warning:|Notice:|Deprecated:'

echo "== event cards fragment"
for path in /event-cards.php /event-cards.php?lang=de; do
	expect_status "$path" 200
	no_cookie "$path"
	has "$path" '(Mo|Di|Mi|Do|Fr|Sa|So)\. [0-9]+\. [A-Z][a-zä]+ [0-9]{4} [0-9]{2}:[0-9]{2} Uhr'
	has "$path" 'Openlab'
	has "$path" 'ChaosTreff'
	hasnt "$path" 'Digital Rights Meetup|LUGS Meetup'
	maybe "$path" 'Netzpolitik-Treff'
	hasnt "$path" '<html'
done
path=/event-cards.php?lang=en
expect_status "$path" 200
has "$path" '(Mon|Tue|Wed|Thu|Fri|Sat|Sun) [0-9]+ [A-Z][a-z]+ [0-9]{4} [0-9]{2}:[0-9]{2}'
hasnt "$path" ' Uhr'
has "$path" 'Openlab'
hasnt "$path" '(Mo|Di|Mi|Do|Fr|Sa|So)\. [0-9]'
hasnt "$path" 'Netzpolitik-Treff|LUGS-Treff'
maybe "$path" 'Digital Rights Meetup'

echo "== /de redirects"
expect_redirect /de /
expect_redirect /de/ /

echo "== other pages"
expect_status /events.php 200
expect_status /static/js/bitw.js 200
has bitw.js '8\.520364'
has bitw.js 'dataset\.src'
expect_status /does-not-exist-$$ 404

echo "== PHP sources are not exposed"
for path in /Page.php /translations.ini /en/index.php /test.php; do
	expect_status "$path" 404
done

echo "== static assets referenced by / and /en/"
grep -ohE '/static/[^"'"'"' )>]+' "$TMP/de.html" "$TMP/en.html" | sort -u > "$TMP/assets"
while read -r asset; do
	code=$(curl -s -o /dev/null -w '%{http_code}' "$BASE$asset")
	if [ "$code" = 200 ]; then
		pass "$asset"
	else
		fail "$asset -> $code"
	fi
done < "$TMP/assets"

echo "== admin"
expect_status /admin.php 200
has admin.php 'name="password"'
code=$(curl -s -o "$TMP/body" -w '%{http_code}' --data-urlencode "password=wrong-$$" "$BASE/admin.php")
grep -q 'name="password"' "$TMP/body" && [ "$code" = 200 ] \
	&& pass "wrong password shows login form again" || fail "wrong password -> $code, no login form"

# real password: read silently, passed to curl via stdin (never on argv or in the log)
pw=$(sed -nE 's/^[[:space:]]*ADMINPASSWORD[[:space:]]*=[[:space:]]*//p' config/.env | head -1 | sed -E 's/^"(.*)"$/\1/; s/^'"'"'(.*)'"'"'$/\1/')
if [ -n "$pw" ]; then
	printf '%s' "$pw" | curl -s -o /dev/null -c "$TMP/jar" -b "$TMP/jar" --data-urlencode "password@-" "$BASE/admin.php"
	curl -s -o "$TMP/body" -b "$TMP/jar" "$BASE/admin.php"
	if grep -q 'name="verein\[\]"' "$TMP/body"; then
		pass "login works, calendar form shown"
		has admin 'value="hackteria"'
		has admin 'value="uwu"'
		grep -q 'value="rl"' "$TMP/body" && fail "admin still offers value=\"rl\"" || pass "admin has no rl option"
	else
		fail "login with ADMINPASSWORD from config/.env did not show calendar form"
	fi
else
	warn "no ADMINPASSWORD in config/.env, skipped logged-in admin checks"
fi
unset pw

echo "== database & logs"
$ENGINE exec "$NAME" ls -l /var/www/config/events.sqlite3 >/dev/null 2>&1 \
	&& pass "events.sqlite3 created in config volume" || fail "events.sqlite3 not created"
$ENGINE logs "$NAME" > "$TMP/logs" 2>&1
if grep -Ei 'PHP (Fatal|Parse|Warning|Notice|Deprecated)|\[(alert|error)\]' "$TMP/logs"; then
	fail "errors/warnings in container log (see above)"
else
	pass "no PHP errors/warnings in container log"
fi

echo "== summary: $PASS passed, $FAIL failed, $WARN warnings"
[ "$FAIL" -eq 0 ]
