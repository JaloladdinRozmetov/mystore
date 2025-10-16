# mystore
git clone <repo-url> project
cd project
composer install
cp .env.example .env
php artisan key:generate

# редактируем .env -> указываем DB_*

php artisan migrate --seed
php artisan storage:link

npm install
npm run dev   # или npm run build

# reload app (локально)
php artisan serve
