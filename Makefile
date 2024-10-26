.PHONY: build

DC := docker-compose -f docker-compose.dev.yml
PHP := $(DC) exec php-fpm

env:
	cp .env.example .env

build:
	@$(DC) build

build-with-xdebug:
	@$(DC) build php-fpm --build-arg XDEBUG_ENABLED=true

start:
	@$(DC) up -d
stop:
	@$(DC) stop
restart: stop start

ssh:
	@$(DC) exec php-fpm bash

generate-key:
	@$(PHP) php artisan key:generate

composer-install:
	@$(PHP) composer install

pint:
	@$(PHP) ./vendor/bin/pint -v
