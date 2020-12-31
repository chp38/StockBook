#!/bin/bash

docker-compose down
docker-compose build
docker-compose up -d

sleep 10

cp ./env.example .env
php artisan key:generate
composer install

docker exec -it stockbook_app php artisan migrate:fresh --seed
