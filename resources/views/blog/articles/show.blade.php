<x-app-layout>
    @php
    $modelType = class_basename($model);
    $modelId = $model->id;
    $tableName = strtolower(Str::plural($modelType));
    $types = $model->fieldTypes;
    $fieldVals = $model->attributesToArray();
    $attributes = []; // Placeholder for parsed attributes

    $fields = [];
    foreach ($fieldVals as $field => $value) {
        $label = $types[$field]['label'] ?? ucfirst($field);
        $type = $types[$field]['type'] ?? 'text';
        $fields[$field] = compact('label', 'type', 'value');
        if (str_contains($type, '[')) {
        preg_match('/\[(.*?)\]/', $fieldType, $matches);
        $attributes = explode(';', $matches[1]);
     }
    }
    @endphp

    <x-show-model :model="$model" :fields="$fields" :modelId="$modelId" :attributes="$attributes" />
</x-app-layout>
