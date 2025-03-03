init:
	docker-compose up -d
	composer install
	docker exec -it php_app php vendor/bin/doctrine orm:schema-tool:update --force