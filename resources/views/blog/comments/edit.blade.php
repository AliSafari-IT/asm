{{-- resources/views/users/edit.blade.php --}}
<x-app-layout>
    @php
    $types = $model->fieldTypes;
    $fieldVals = $model-> attributesToArray();

    foreach ($fieldVals as $field => $options) {
    $label = $options['label'] ?? ucfirst($field);
    $type = $types[$field] ?? 'text';
    $value = old($field) ?? $model->$field;
    $fields[$field] = compact('label', 'type', 'value');
    }
    $modelType = class_basename($model); // Dynamically get the model's class name
    $modelId = $model->id;
    // Assuming route names follow a pluralized, lowercase model naming convention
    $tableName = strtolower(Str::plural($modelType));
    @endphp

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit '.e($modelType).': '.$model->name) }}
    </x-slot>
    @component('layouts.toolbar')
    @slot('actions')
    <a href="{{ route($tableName.'.index') }}"
        class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
    <a href="{{ route($tableName.'.show', [$model]) }}"
        class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Show</a>
    <a href="{{ route('delete.confirmation', ['tableName' => $tableName, 'modelId' => $model->id]) }}"
        class="ml-4 text-red-500 hover:text-red-700">Delete</a>
    @endslot
    @endcomponent
    @isset($modelType, $modelId)
    <x-edit-model :model="$model" :fields="$fields" />

    @else
    {{-- Handle the case where variables are not set --}}
    <p>Error: The required parameters are not available.</p>
    @endisset

</x-app-layout>