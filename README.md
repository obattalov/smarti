# smarti

set correct local prameters in \Database .env file:
DB_HOST
DB_PORT
DB_USERNAME
DB_PASSWORD


execute in command shell:
```
cd smarti
cd Database
composer install
php artisan migrate
php artisan serve --port 8001 &
cd ../Gallery
composer install
php artisan serve --port 8002 &
cd ../Editor
composer install
php artisan serve --port 8003 &
cd ../Frontend
composer install
php artisan serve --port 8000 &
```

open http://127.0.0.1:8001/init/ in browser to populate db pokemons

