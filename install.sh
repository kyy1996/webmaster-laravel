#!/bin/sh

./artisan key:generate
./artisan migrate
./artisan passport:install --force
./artisan db:seed
