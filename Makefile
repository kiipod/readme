#DOCKER DEV
docker-up:
	docker compose up -d
docker-down:
	docker compose down
docker-down-clear:
	docker compose down -v --remove-orphans

#ASSET_MAPPER
compile:
	php bin/console asset-map:compile

#APP
migration:
	php bin/console make:migration
migrate:
	php bin/console doctrine:migrations:migrate
fixt-load:
	php bin/console doctrine:fixtures:load
