#DOCKER DEV
docker-up:
	docker compose up -d
docker-down:
	docker compose down --remove-orphans
docker-down-clear:
	docker compose down -v --remove-orphans

#ASSET_MAPPER
compile:
	php bin/console asset-map:compile
