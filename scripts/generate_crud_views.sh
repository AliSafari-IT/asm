#!/bin/bash

# Check if an argument was provided
if [ "$#" -ne 1 ]; then
    echo "Usage: $0 <table-name>"
    exit 1
fi

# Directory and file setup
TABLE_NAME=$1
VIEWS_DIR="resources/views/blog/${TABLE_NAME}"

# Dynamically set 'User' to actual model type derived from table name
modelType=$(echo "${TABLE_NAME}" | perl -pe 's/(^|_)./uc($&)/ge;s/_//g')

# Create the directory if it doesn't exist
mkdir -p "${VIEWS_DIR}"

# Array of CRUD operation views
declare -a VIEWS=("index" "create" "edit" "show" "destroy")

# Loop through the views and create each Blade file
for VIEW in "${VIEWS[@]}"; do
    touch "${VIEWS_DIR}/${VIEW}.blade.php"
    content=""
    # Define the content of each Blade file based on the VIEW
    if [[ "${VIEW}" == "index" ]]; then
        content="@php
                \$modelType = '${modelType}';
                \$columns=['id' => 'ID', 'name' => 'Name', 'email' => 'Email'];

                \$models = \"\\App\\Models\\$modelType\"::all();
                \$tableName = strtolower(Str::plural(\$modelType));
                \$modelsCreateRoute = \$tableName.'.create';
                \$has_header = (strpos(url()->current(), \$tableName) !== false && strpos(url()->current(), 'create') === false);
                @endphp

                <!-- Conditional Layout -->
                @if(\$has_header)
                <x-app-layout>
                @else
                <div>
                @endif
                    <x-slot name=\"header\">
                        <h2 class=\"font-semibold text-xl text-gray-800 leading-tight\">
                            {{ __(\$modelType . 's') }}
                        </h2>
                    </x-slot>
                    <x-top-menu-container name=\"headerActions\" class=\"m-6 w-8/12 mx-auto mt-10\">
                        <x-create-new-button :route=\"\$modelsCreateRoute\" :text=\"'Add New ' . \$modelType\" />
                    </x-top-menu-container>

                    <!-- Models Table -->
                    <x-show-models :models=\"\$models\" :columns=\"\$columns\" :tableName=\"\$tableName\" />

                @if(\$has_header)
                </x-app-layout>
                @else
                </div>
                @endif"

    elif [[ "${VIEW}" == "create" ]]; then
        content="<x-app-layout>
                    <div>    
                    @php
                        \$newModel = new /App/Models/${modelType}();
                        \$newModel->initialValues = \$newModel->getInitialValues();
                        \$newModel->fieldTypes = \$newModel->getFieldTypes();
                        \$newModel->rules = \$newModel->getRules();
                        \$newModel->messages = \$newModel->getRulesMessages();
                    @endphp
                    @livewire('create-new-instance', [ 'instanceModel' => \$newModel, 'modelType' => '${modelType}'])
                    </div>
                </x-app-layout>"
        
    elif [[ "${VIEW}" == "edit" ]]; then
         content="<x-app-layout>
                    @php
                    \$types = \$model->fieldTypes;
                    \$fieldVals = \$model->attributesToArray();

                    foreach (\$fieldVals as \$field => \$options) {
                        \$label = \$options['label'] ?? ucfirst(\$field);
                        \$type = \$types[\$field] ?? 'text';
                        \$value = old(\$field) ?? \$model->\$field;
                        \$fields[\$field] = compact('label', 'type', 'value');
                    }
                    \$modelType = class_basename(\$model); // Dynamically get the model's class name
                    \$modelId = \$model->id;
                    // Assuming route names follow a pluralized, lowercase model naming convention
                    \$tableName = strtolower(Str::plural(\$modelType));
                    @endphp

                    <x-slot name=\"header\">
                        <h2 class=\"font-semibold text-xl text-gray-800 leading-tight\">
                            {{ __('Edit '.e(\$modelType).': '.\$model->name) }}
                        </h2>
                    </x-slot>
                    @component('layouts.toolbar')
                    @slot('actions')
                    <a href=\"{{ route(\$tableName.'.index') }}\"
                        class=\"ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline\">Back</a>
                    <a href=\"{{ route(\$tableName.'.show', [\$model]) }}\"
                        class=\"ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline\">Show</a>
                    <a href=\"{{ route('delete.confirmation', ['tableName' => \$tableName, 'modelId' => \$model->id]) }}\"
                        class=\"ml-4 text-red-500 hover:text-red-700\">Delete</a>
                    @endslot
                    @endcomponent
                    @isset(\$modelType, \$modelId)
                    <x-edit-model :model=\"\$model\" :fields=\"\$fields\" />

                    @else
                    {{-- Handle the case where variables are not set --}}
                    <p>Error: The required parameters are not available.</p>
                    @endisset

                </x-app-layout>"

    elif [[ "${VIEW}" == "show" ]]; then
              content="<x-app-layout>
                        @php
                        \$modelType = class_basename(\$model);
                        \$modelId = \$model->id;
                        \$tableName = strtolower(Str::plural(\$modelType));
                        @endphp
                        <div>
                            @livewire('display-model-instance', ['instanceModel' => \$model, 'modelType' => \$modelType, 'modelId' =>
                            \$modelId, 'tableName' => \$tableName])
                        </div>
                    </x-app-layout>"
    elif [[ "${VIEW}" == "destroy" ]]; then
        content="<!-- destroy.blade.php -->
                <x-app-layout>
                    <div>
                        @livewire('delete-model-instance', ['modelType' => '${modelType}', 'modelId' => \$modelId])
                    </div>
                </x-app-layout>"    
    fi

    # Write the content to the file
    echo -e "${content}" > "${VIEWS_DIR}/${VIEW}.blade.php"
done

echo "CRUD views for ${TABLE_NAME} generated successfully."
read -p "Press [Enter] key to continue..."
