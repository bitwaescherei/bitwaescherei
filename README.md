## Bitwäscherei-Homepage

Simple website to display information and impressions about the hacker-space-collective Bitwäscherei in Zürich (Switzerland).

If you would like to contribute and update some information, create a pull request or fork the page.

### Structure

| URL | Source | |
|---|---|---|
| `/` and `/en/` | `site/index.php` | German and English home page, rendered to static `index.html` files at image build time |
| `/static/` | `site/static/` | CSS, JS, fonts and images |
| `/event-cards.php?lang=de\|en` | `site/event-cards.php` | HTML fragment with the next events, loaded into the home pages by `bitw.js` |
| `/events.php` | `site/events.php` | stand-alone list of the next events in large print, e.g. for a screen in the space |
| `/admin.php` | `site/admin.php` | password protected editor for the events |

All texts of the home pages, in both languages, are in `config/translations.ini`.
`site/Page.php` holds the event logic, including the weekly recurring events.
In the container image the PHP files are kept outside of the web root, only the
PHP URLs above are routed to PHP (see `config/conf.json`), everything else is either
a static file or a 404. The events are saved in SQLite3 and the admin password
is set in `config/.env`.

To render a home page without the container: `php site/index.php en > en.html`

### Building / Running the Container image

This image gets built and published to `ghcr.io/bitwaescherei/bitwaescherei:<tag>`
upon tagging a commit on the master branch.

```shell
# building the container image - docker format is optional, but will include a healthcheck
podman build --tag bitwaescherei --file config/Containerfile --format docker .
# create a config file with your credential
echo 'ADMINPASSWORD=<your credential here>' > config/.env
# try it out: the database gets created in a temporary volume, removed with the container
podman run -ti --rm -p 8080:8080 -v $PWD/config/.env:/var/www/config/.env:ro,Z bitwaescherei
# in production, mount a directory writable by UID 100 / GID 82 on /var/www/config
# to keep the database at /var/www/config/events.sqlite3 - and back it up
```

### Verifying the Container image

`.github/verify.sh` builds the image, runs it and smoke-tests the pages, the
admin login and the routing (PHP sources must not be reachable). It creates
`config/.env` with a random password if there is none and writes its output to
`verify.log`. The GitHub workflow runs it on every push and only publishes
tagged images that pass.
