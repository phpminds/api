[![Known Vulnerabilities](https://snyk.io/test/github/phpminds/api/badge.svg?targetFile=composer.lock)](https://snyk.io/test/github/phpminds/api?targetFile=composer.lock)

# PHPMiNDS API

An API to retrieve latest and past events.

### Overview

Retrieve active (latest) and past events for PHPMiNDS.

The latest event is synced with the DB from `Meetup.com`, through the `nottingham.digital` API.

A call to `nottingham.digital` API happens only once and then the latest event is retrieved from the DB. However there is a setting that allows the content to be updated.

### Development

For an initial setup, update `.env` with the database credentials, and run:

`composer build-dev`

Use the Postman Collection in the `docs` folder.
