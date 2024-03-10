run:
	cp ./src/.env.example ./src/.env
	docker compose down
	docker compose build
	docker compose up -d
	docker exec php /bin/sh -c "composer install && php artisan cache:clear && chmod -R 777 storage && php artisan key:generate && php artisan migrate"
