#!/bin/bash

# Usage: ./makeModel.sh ModelName
echo "creating new component..."
echo "Component name (eg. MyComponent): "
php artisan make:component $1

# pause
 read -p "Press [Enter] key to continue..."