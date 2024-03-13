#!/bin/bash

# Usage: ./makeLivewire.sh Livewire_component_name

php artisan make:livewire $1

# pause
# read -p "Press [Enter] key to continue..."