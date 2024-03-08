#!/bin/bash

# Usage: ./makeModel.sh ModelName

php artisan make:controller App\\Http\\Controllers\\$1Controller

# pause
 read -p "Press [Enter] key to continue..."