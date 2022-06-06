# astrology-app
![img.png](public/images/astro.png)

```bash
git clone https://github.com/MaxEpam2015/astrology-app.git
```

## Prerequisites for building project just by 1 command:
#### OS - Linux|Ubuntu (I've tested on v20.04.4)
#### installed composer globally (I've tested on v2.1.3)
#### installed docker & docker-compose 
#### installed php >=8.0.2

# Building project command:

```bash
make i
```

# Manually building project:


```bash
make up
```

## Composer installation:
```bash
composer i 
```

## Application Key generation
### If you have installed "php": "^8.0":
```bash
php artisan key:generate
```

### Else:
```bash
docker exec -it astro_php-fpm bash 
php artisan key:generate
cp -v .env.example .env
```

### Test db creation:
```bash
docker exec -it  mysql bash
mysql -uroot -p
CREATE DATABASE astro_db_test;
```

# Other available commands

```text
Possible commands are:
  - make up            : docker-compose up -d
  - make down          : docker-compose down
  - make docker-build  : docker-compose up --build -d
  - make test          : docker-compose exec php-cli vendor/bin/phpunit
  - make queue         : docker-compose exec php-cli php artisan queue:work
  - make perm          : sudo chgrp -R www-data storage bootstrap/cache
                         sudo chmod -R ug+rwx storage bootstrap/cache
  - make script        : cp -v .env.example .env
                         cp -v .env.testing.example .env.testing
                         /usr/local/bin/composer i
                         php artisan key:generate
                         make queue

```
