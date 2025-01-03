#DOCKER DEV
docker-up:
	docker compose up -d
docker-down:
	docker compose down
docker-down-clear:
	docker compose down -v --remove-orphans

#WEBPACK ENCORE
compile:
	npm run dev
prod-build:
	npm run build

#APP
migration:
	docker exec -it app php bin/console make:migration
migrate:
	docker exec -it app php bin/console doctrine:migrations:migrate
fixt-load:
	docker exec -it app php bin/console doctrine:fixtures:load
cache-clear:
	docker exec -it app php bin/console cache:clear
worker:
	docker exec -it app php bin/console messenger:consume async --time-limit=3600 --memory-limit=128M
