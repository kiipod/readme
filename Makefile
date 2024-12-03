#DOCKER DEV
docker-up:
	docker compose up -d
docker-down:
	docker compose down
docker-down-clear:
	docker compose down -v --remove-orphans

#WEBPACK_ENCORE
compile:
	npm run dev
prod-build:
	npm run build

#APP
migration:
	php bin/console make:migration
migrate:
	php bin/console doctrine:migrations:migrate
fixt-load:
	php bin/console doctrine:fixtures:load
