#!/bin/bash

docker-compose exec app composer install
status=$?
if [ $status -ne 0 ]; then
  echo "Failed composer install: $status"
  exit $status
fi

docker-compose exec app php artisan key:generate
status=$?
if [ $status -ne 0 ]; then
  echo "Failed to start key:generate: $status"
  exit $status
fi

docker-compose exec app php artisan migrate
status=$?
if [ $status -ne 0 ]; then
  echo "Failed migration: $status"
  exit $status
fi

docker-compose exec app php artisan db:seed --class=DatabaseSeeder
status=$?
if [ $status -ne 0 ]; then
  echo "Failed seeding: $status"
  exit $status
fi

npm install
status=$?
if [ $status -ne 0 ]; then
  echo "Failed npm install: $status"
  exit $status
fi

npm run build
status=$?
if [ $status -ne 0 ]; then
  echo "Failed to build production: $status"
  exit $status
fi
