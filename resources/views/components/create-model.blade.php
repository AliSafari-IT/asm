@props([
'model',
])

@php
$modelType = class_basename($model);
$fields = $model->initialValues;
$tableName = strtolower(Str::plural($modelType));
@endphp


<div class="max-w-4xl mx-auto py-10">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Create a new {{ $modelType }}
            </h3>
        </div>

        {{-- Validation Error Display --}}
        @error('model')
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ $message }}</span>
        </div>
        @enderror


        <form action="{{ route($tableName . '.store') }}" method="POST" class="space-y-6 px-4 py-5 sm:p-6">
            @csrf
            @foreach ($fields as $fieldName => $options)
            @include('components.field', ['field' => $fieldName, 'options' => $options])
            @endforeach
            <div class="flex justify-between items-center">
                <a href="{{ route($tableName . '.index') }}"
                    class="text-sm font-medium text-blue-600 hover:text-blue-500">
                    Back to list
                </a>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Create {{ $modelType }}
                </button>
            </div>
        </form>
    </div>
</div>