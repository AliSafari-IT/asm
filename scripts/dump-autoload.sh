composer dump-autoload

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# pause
read -p "Press [Enter] key to continue..."