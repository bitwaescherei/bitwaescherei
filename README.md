## Bitwäscherei-Homepage

Simple website to display information and impressions about the hacker-space-collective Bitwäscherei in Zürich (Switzerland).

If you would like to contribute and update some information, create a pull request or fork the page.

### Installation / Requirements

This page uses PHP to allow configuration of events.
Copy .env.example to .env and set a password. SQLite3 is used to save the events.

### Building / Running the Container image

This image gets built and published to `ghcr.io/bitwaescherei/bitwaescherei:<tag>`
upon tagging a commit on the master branch.

```shell
# building the container image - docker format is optional, but will include a healthcheck
podman build --tag bitwaescherei --file config/Containerfile --format docker .
# create a config file with your credential
echo 'ADMINPASSWORD=<your credential here>' > config/.env
# database gets created at /var/www/config/events.sqlite3, so be sure make it writable and back it up
podman run -ti --rm -p 8080:8080 --tmpfs /var/www/config -v $PWD/config/.env:/var/www/config/.env bitwaescherei
```
