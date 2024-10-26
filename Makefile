.PHONY: build

DC := docker-compose -f docker-compose.dev.yml

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

# Run inside containers for compatability with not only UNIX systems
# ==================================================================

generate-key:
	@php artisan key:generate

composer-install:
	@composer install

pint:
	@./vendor/bin/pint -v
