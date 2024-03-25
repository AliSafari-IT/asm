{{-- resources/views/users/create.blade.php --}}
<x-app-layout>
    @php
    $modelType = 'User';
    $model = new \App\Models\User();
    $model->fieldTypes = $model->getUserFieldTypes();
    $model->rules = $model->getUserRules();
    $model->messages = $model->getUserRulesMessages();
    $tableName = strtolower(Str::plural($modelType));

    $types = $model->fieldTypes;
    $fields = [];
    foreach ($types as $key => $value) {
    $fields[$key] = [
    'label' => $value['label'] ?? ucfirst($key),
    'type' => $value['type'] ?? 'text',
    'value' => $value['value'] ?? ''
    ];
    }

    $model->tableName = $tableName;
    $model->initialValues = $fields;
    @endphp

   <!-- Show data validation errors -->
@if ($errors->any())
<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mx-12" role="alert">
    <p class="font-bold">Please fix the following errors:</p>
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li >{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


    <x-create-model :model="$model" />
</x-app-layout>