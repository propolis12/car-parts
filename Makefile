.PHONY: start

start:
	docker compose up -d
	docker compose run --rm composer install
	docker compose exec app bash -lc "if ! grep -q '^APP_KEY=base64:' .env || grep -q '^APP_KEY=$$' .env; then php artisan key:generate; else echo 'APP_KEY OK'; fi"

	docker compose exec app php artisan migrate --force

	docker compose run --rm node npm install
	docker compose run --rm node npm run build
	@echo ""
	@echo "✅ Hotovo. Otvor: http://localhost:8080"
