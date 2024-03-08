#!/bin/bash

# Usage: ./makeModel.sh ModelName

php artisan make:model App\\Models\\$1 --migration 

# pause
# read -p "Press [Enter] key to continue..."