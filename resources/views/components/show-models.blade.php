{{-- resources/views/components/model-table.blade.php --}}
@props([
    'models', // The collection of models to display
    'columns', // Associative array of columns to display ['name' => 'Display Name']
    'actionsWidth' => 'w-3/12', // Width class for the actions column
    'tableName' // Used to build route names for actions
])

<div class="overflow-x-auto rounded-lg shadow overflow-hidden mb-8 w-8/12 mx-auto mt-10">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="text-left text-gray-700 bg-gray-100">
                @foreach ($columns as $column => $displayName)
                    <th class="px-5 py-3 border-b-2 border-gray-200">{{ $displayName }}</th>
                @endforeach
                <th class="px-5 py-3 border-b-2 border-gray-200 {{ $actionsWidth }}">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($models as $model)
                <tr class="hover:bg-gray-50">
                    @foreach ($columns as $column => $displayName)
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{ $model->$column }}
                        </td>
                    @endforeach
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                        {{-- Assuming naming convention for route names --}}
                        <a href="{{ route($tableName.'.edit', $model) }}" class="hover:bg-green-400 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            <i class="fas fa-edit ml-2"></i>
                        </a>
                        <a href="{{ route($tableName.'.show', $model) }}" class="hover:bg-blue-300 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            <i class="fas fa-eye ml-2"></i>
                        </a>
                        <a href="{{ route('delete.confirmation', ['tableName' => $tableName, 'modelId' => $model->id]) }}" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash ml-2"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-5 py-10 border-b border-gray-200 bg-white text-sm text-center" colspan="{{ count($columns) + 1 }}">
                        No {{ $tableName }} Found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
