#!/bin/bash

set -e

if [[ -f .env.example ]]; then
  cp -v .env.example .env
fi

if [[ -f .env.testing.example ]]; then
  cp -v .env.testing.example .env.testing
fi

/usr/local/bin/composer i

php artisan key:generate

make perm

make queue

