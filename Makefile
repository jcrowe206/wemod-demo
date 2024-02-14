ROOT_DIR := $(dir $(realpath $(lastword $(MAKEFILE_LIST))))

COMPOSE=docker-compose

exec:
	@${COMPOSE} exec -- jcrowe-wemod-php ${CMD}

build:
	@${COMPOSE} up -d --build
	@${COMPOSE} exec -- jcrowe-wemod-php composer install
	@${COMPOSE} exec -- jcrowe-wemod-php php artisan migrate
