up:
	docker-compose up -d --build
	docker exec -it php_app composer install

down:
	docker-compose down

logs:
	docker-compose logs -f

shell:
	docker exec -it php_app bash

migrate:
	docker exec -it mysql_db mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS pruebatecnica;"
	docker exec -it mysql_db mysql -u root -p -e "USE pruebatecnica; CREATE TABLE IF NOT EXISTS users ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP );"

tests:
	docker exec -it php_app php vendor/bin/phpunit