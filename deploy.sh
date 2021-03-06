#!/bin/bash

docker-compose down
docker-compose build
docker-compose up -d

sleep 10
docker exec -it stockbook_app php artisan migrate:fresh --seed
