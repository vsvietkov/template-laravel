.PHONY: build

DC := docker-compose -f docker-compose.dev.yml
PHP := $(DC) exec -it php-fpm

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

generate-key:
	@$(PHP) php artisan key:generate

composer-install:
	@$(PHP) composer install

migrate:
	@$(PHP) php artisan migrate
seed:
	@$(PHP) php artisan db:seed
refresh:
	@$(PHP) php artisan migrate:refresh --seed
truncate:
	@$(PHP) php artisan db:wipe

ssh:
	@$(DC) exec php-fpm bash

pint:
	@$(PHP) ./vendor/bin/pint -v
