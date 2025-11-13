#!/bin/sh
set -e

CYAN='\x1b[36m'
MAGENTA='\x1b[35m'
BLUE='\x1b[34m'

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

if [ "$1" = 'php-fpm' ] || [ "$1" = 'artisan' ]; then

	echo "Launch project Lunar!"

	# Wait for database connection
	until nc -z -v -w30 db 5432; do
	  echo "Waiting for database connection..."
	  sleep 5
	done

 echo "Setting storage and cache permissions..."
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache


	# Only run Lunar install if not installed yet
	if [ -d "config/lunar" ]; then
		echo -e "$MAGENTA Lunar already installed 🚀"
	else
		echo -e "$BLUE Starting installation..."
		composer install || echo "Composer install failed, continuing..."
		php artisan migrate || echo "Migration failed, continuing..."

		# Check if artisan commands exist before running them
		if php artisan list | grep -q 'lunarphp:create-admin'; then
			php artisan lunarphp:create-admin --firstname=${ADMIN_FIRSTNAME} --lastname=${ADMIN_LASTNAME} --email=${ADMIN_EMAIL} --password=${ADMIN_PASSWORD}
			php artisan lunarphp:install -n
			php artisan db:seed
			php artisan storage:link
			php artisan lunarphp:search:index
		else
			echo "Lunar commands not available yet, skipping installation..."
		fi
	fi

	echo -e "Your project is live! Storefront available here: http://localhost"
fi

# Start PHP-FPM
exec docker-php-entrypoint "$@"
