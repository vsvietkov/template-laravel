.PHONY: build

DC := docker-compose -f docker-compose.dev.yml
PHP := $(DC) exec -it php-fpm
NODE := $(DC) exec node

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
node-install:
	@$(NODE) pnpm install

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
ssh-node:
	@$(DC) exec node bash

pint:
	@$(PHP) ./vendor/bin/pint -v --test
pint-fix:
	@$(PHP) ./vendor/bin/pint -v
node-lint:
	@$(NODE) pnpm run lint
node-lint-fix:
	@$(NODE) pnpm run lint:fix

test:
	@$(PHP) php artisan test

node-dev:
	@$(NODE) pnpm run dev
node-build:
	@$(NODE) pnpm run build
