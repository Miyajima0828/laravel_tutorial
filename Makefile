init:
	@make build
	@make up-no-logs
	@make composer-install
	docker compose exec app cp .env.example .env
	docker compose exec app php artisan key:generate
	@make npm-install


up:
	docker compose up -d

fresh:
	docker compose exec app php artisan migrate:fresh --seed

ps:
	docker compose ps

down:
	docker compose down

down-v:
	docker compose down -v

restart:
	@make down
	@make up-no-logs

login-app:
	docker compose exec app bash

login-db:
	docker compose exec db bash

build:
	docker compose build

composer-install:
	docker compose exec app composer install

npm-install:
	docker compose exec app npm install

npm-run-dev:
	docker compose exec app npm run dev

npm-run-build:
	docker compose exec app npm run build

test:
	docker compose exec app php artisan test

test-a:
	docker compose exec app php artisan test --group a