@props([
    'model', // The model to display
    'modelId',
    'fields', // Associative array of fields to display ['name' => 'Display Name']
    'actionsWidth' => 'w-3/12', // Width class for the actions column
    'attributes', // Associative array of attributes to display ['name' => 'Display Name']
])
@php
    $modelName = get_class($model);
    $modelType = class_basename($modelName);
    $tableName = strtolower(Str::plural($modelType));
@endphp
<div class="max-w-4xl mx-auto py-10">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Article Details
            </h3>
        </div>
        <div class="px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-200">
                {{-- Dynamic field rendering --}}
                @foreach ($fields as $field => $options)
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ $options['label'] ?? ucfirst($field) }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-3 sm:mt-0">
                            @if($field === 'images' && is_array($options['value']))
                                <div class="flex space-x-4">
                                    @foreach($options['value'] as $image)
                                        <img src="{{ asset($image) }}" alt="{{ $image.' preview' }}" class="w-32 h-32 object-cover rounded-lg">
                                    @endforeach
                                </div>
                            @elseif($options['type'] === 'textarea' || $field === 'body' || $field === 'content')
                                @php
                                    $options['value'] = strip_tags($options['value']);
                                    $options['value'] = preg_replace('/\s+/', ' ', $options['value']);
                                    
                                @endphp
                                <div class="prose max-w-none">
                                    {!! nl2br(e($options['value'])) !!}
                                </div>
                            @else
                                {{ $options['value'] }}
                            @endif
                        </dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </div>
    <div class="mt-4 flex justify-between items-center">
            <a href="{{ route($tableName . '.index') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Back to list
            </a>
            <a href="{{ route($tableName . '.edit', $modelId) }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Edit Instance
            </a>
        </div>
</div>
