{{-- resources/views/components/edit-model.blade.php --}}
@props(['model', 'fields'])
@php
    $modelType = class_basename($model); // Dynamically get the model's class name
    $routePrefix = strtolower(Str::plural($modelType)); // Assuming route names follow a pluralized, lowercase model naming convention
@endphp

<div class="max-w-4xl mx-auto py-10">
    <form action="{{ route($routePrefix.'.update', $model->id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        @foreach ($fields as $field => $options)
            @php
                $label = $options['label'] ?? ucfirst($field);
                $inputType = $options['type'] ?? 'text';
                $value = old($field) ?? $model->$field;
            @endphp

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $field }}">{{ $label }}</label>
                @if ($inputType === 'textarea')
                    <textarea id="{{ $field }}" name="{{ $field }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $value }}</textarea>
                @else
                    <input type="{{ $inputType }}" id="{{ $field }}" name="{{ $field }}" value="{{ $value }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @endif
            </div>
        @endforeach

        <div class="flex items-center justify-between">
            <a href="{{ route($routePrefix.'.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Save Changes</button>
        </div>
    </form>
</div>
