[![Known Vulnerabilities](https://snyk.io/test/github/phpminds/api/badge.svg?targetFile=composer.lock)](https://snyk.io/test/github/phpminds/api?targetFile=composer.lock)

# PHPMiNDS API

An API to retrieve latest and past events.

### Overview

Retrieve active (latest) and past events for PHPMiNDS.

The latest event is synced with the DB from `Meetup.com`, through the `nottingham.digital` API.

A call to `nottingham.digital` API happens only once and then the latest event is retrieved from the DB. However there is a setting that allows the content to be updated.

### Development

For an initial setup, update `.env` with:

* the database credentials. Use `127.0.0.1` to run on the _host_ and `phpminds-api-db` to run inside docker.
* `WEB_APP_PATH` should be changed with your project's path

Load the Docker dev environment: `docker-compose up -d`

If you're running both the `Web server` and `DB` from within Docker (that's the default setup), connect to `phpminds-api-web`:

`docker-compose exec phpminds-api-web bash`

And then run:

`composer build-dev`

If you're running a local web server under `127.0.0.1`:

`composer build-dev`


Use the Postman Collection in the `docs` folder.
