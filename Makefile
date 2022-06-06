i: up script

script:
	./.scripts/install-app.sh

up: memory
	docker-compose up -d

down:
	docker-compose down

docker-build: memory
	docker-compose up --build -d

test:
	docker-compose exec php-cli vendor/bin/phpunit

queue:
	docker-compose exec php-cli php artisan queue:work

memory:
	sudo sysctl -w vm.max_map_count=262144

perm:
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache
