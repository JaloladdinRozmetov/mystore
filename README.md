git clone https://github.com/JaloladdinRozmetov/mystore.git project
cd project
composer install
cp .env.example .env
php artisan key:generate

php artisan migrate --seed
php artisan storage:link
