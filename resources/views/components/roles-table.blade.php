@php
$descriptionWidth = 'w-5/12';
@endphp
<div class="overflow-x-auto rounded-lg shadow overflow-hidden mb-8 w-8/12 mx-auto mt-10">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="text-left text-gray-700 bg-gray-100">
                <th class="px-5 py-3 border-b-2 border-gray-200">ID</th>
                <th class="px-5 py-3 border-b-2 border-gray-200">Role Name</th>
                <th class="px-5 py-3 border-b-2 border-gray-200">Description</th>
                <th class="px-5 py-3 border-b-2 border-gray-200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">{{ $role->id }}</td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">{{ $role->name }}</td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm {{ $descriptionWidth }}">{{ $role->description }}</td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('roles.edit', [$role]) }}"
                            class="hover:bg-green-400 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Edit <i class="fas fa-edit ml-2"></i>
                        </a>
                        <a href="{{ route('roles.show', [$role]) }}"
                            class="hover:bg-blue-300 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            View <i class="fas fa-eye ml-2"></i>
                        </a> 
                        <a href="{{ route('delete.confirmation', ['modelType' => 'Role', 'modelId' => $role->id]) }}"
                        class="hover:bg-red-400 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Remove <i class="fas fa-trash ml-2"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

