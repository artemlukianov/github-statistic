#!/usr/bin/env bash
#project init commend
docker-compose build --no-cache
docker-compose down --remove-orphans
docker-compose up -d
docker-compose exec -T app bash -c 'composer install -o --apcu-autoloader --no-interaction'