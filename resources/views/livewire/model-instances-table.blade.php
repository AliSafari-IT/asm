{{--resources/views/livewire/model-instances-table.blade.php--}}
@php
$descriptionClass = 'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600';
@endphp
<div class="overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class="px-3 py-3">Name</th>
                @if(!$hasHeader)
                <th class="px-3 py-3">Slug</th>
                @endif
                @if($hasHeader)
                <th class="px-3 py-3 {{ $descriptionClass }}">Description</th>
                @endif
                <th class="px-6 py-3">Action</th>
            </tr>
        </thead>
        @php
        $modelTypeLower = strtolower($modelType);        
        @endphp
        <tbody>
            @foreach ($modelInstances as $instance)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-3 py-1">{{ $instance['name'] }}</td>
                @if(!$hasHeader)
                <td class="px-3 py-1">{{ $instance['slug']}}</td>
                @endif
                @if($hasHeader)
                <td class="px-3 py-1 truncate  {{ $descriptionClass }}">{{ $instance['description'] }}</td>
                @endif
                <td class="px-3 py-1">
                    {{-- Conditional View Link --}}
                    <a href="{{ route($modelTypeLower . '.show', ['id' => $instance['id']]) }}"
                        class="text-blue-500 hover:text-blue-700 mx-2">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    @if($hasHeader)
                    {{-- Conditional Edit Link --}}
                    <a href="{{ route($modelTypeLower . '.edit', ['id' => $instance['id']]) }}"
                        class="text-blue-500 hover:text-blue-700 mx-2">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    {{-- Conditional Delete Link --}}
                    <a href="{{ route('delete.confirmation', ['modelType' => $modelType, 'modelId' => $instance['id']]) }}"
                        class="text-red-500 hover:text-red-700 mx-2">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>