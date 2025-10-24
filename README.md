staci spustis make start v priecinku projektiu v konzole, ak by hadzalo chybu Failed to open stream: Permission denied.  - treba sputit tento prikaz:

docker compose exec app bash -lc 'php artisan config:clear && php artisan view:clear && php artisan cache:clear'

