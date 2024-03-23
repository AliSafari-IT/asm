#!/bin/bash

# Check if an argument was provided
if [ "$#" -ne 1 ]; then
    echo "Usage: $0 <table-name>"
    exit 1
fi

# Directory and file setup
TABLE_NAME=$1
VIEWS_DIR="resources/views/blog/${TABLE_NAME}"

# Create the directory if it doesn't exist
mkdir -p ${VIEWS_DIR}

# Array of CRUD operation views
declare -a VIEWS=("index" "create" "edit" "show" "delete" )

# Loop through the views and create each Blade file
for VIEW in "${VIEWS[@]}"; do
    touch "${VIEWS_DIR}/${VIEW}.blade.php"
    echo "@extends('layouts.app')" > "${VIEWS_DIR}/${VIEW}.blade.php"
    echo "@section('content')" >> "${VIEWS_DIR}/${VIEW}.blade.php"
    echo "    <h1>${VIEW} ${TABLE_NAME}</h1>" >> "${VIEWS_DIR}/${VIEW}.blade.php"
    echo "@endsection" >> "${VIEWS_DIR}/${VIEW}.blade.php"
done

echo "CRUD views for ${TABLE_NAME} generated successfully."
