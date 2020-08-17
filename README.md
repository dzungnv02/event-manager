# event-manager
Writing a back-end system to manage events.

## Install
Pre-required
  - Docker & Docker Compose installed

Installation steps:
  - Download or clone source code from this repository
  - Open Terminals, run commands:
```sh
$ cd ./event_manager
$ docker network create event_manager.localhost
$ docker volume create event_db_vol
$ docker-compose build
$ docker-compose up -d
$ docker exec -it event_manager /bin/sh
/var/www/html $ composer install
/var/www/html $ php migrate
```

## Run Reminder Job:
```sh
$ docker exec -it event_manager /bin/sh
/var/www/html $ composer install
/var/www/html $ php reminder
```

## APIs:
 - Get all events: [GET] http://localhost:8003/api/events
 - Get an event: [GET] http://localhost:8003/api/event/:id
 - Create new event: [POST] http://localhost:8003/api/event, [REQUEST BODY]: {"title":string, "start":datetime, "end":datetime, "reminder": 0|1}
 - Update an event: [POST] http://localhost:8003/api/event/:id, [REQUEST BODY]: {"title":string, "start":datetime, "end":datetime, "reminder": 0|1}
 - Delete an event: [DELETE] http://localhost:8003/api/event/:id

## Run Unit Test for APIs
```sh
$ docker exec -it event_manager /bin/sh
/var/www/html $ ./vendor/bin/phpunit
```