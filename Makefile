.PHONY: help start stop run tests fix-code

help:
	@echo "Available commands:"
	@echo "  make start    : Run the project using Docker"
	@echo "  make stop     : Stop the Docker containers"
	@echo "  make run      : Run the index.php script"
	@echo "  make tests    : Run tests using PHPUnit"
	@echo "  make fix-code  : Automatically fix code using php-cs-fixer"
	@echo "  make help     : Display this help message"

start:
	docker-compose up -d

stop:
	docker compose down

run:
	php index.php

tests:
	docker compose exec app vendor/bin/phpunit .

fix-code:
	docker compose exec app vendor/bin/php-cs-fixer fix src