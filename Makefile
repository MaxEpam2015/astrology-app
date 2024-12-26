i: up script

script:
	./.docker/scripts/install-app.sh

up:
	docker-compose up -d

down:
	docker-compose down

docker-build:
	docker-compose up --build -d

test:
	docker-compose exec php-cli vendor/bin/phpunit

queue:
	docker-compose exec php-cli php artisan queue:work

perm:
	sudo chmod -R ug+rwx storage bootstrap/cache
