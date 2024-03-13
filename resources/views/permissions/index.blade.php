<?php
use App\Models\Permission;
use Illuminate\Support\Facades\Route;

$props=null;

$props.$has_header = isset($use_header) ? $use_header : true;
$props.$title = isset($title) ? $title : 'Permissions';
$props.$cr = isset($cr) ? $cr : 'dashboard';
$props.$modelType = isset($modelType) ? $modelType : 'Permission';
$props.$modelId = isset($modelId) ? $modelId : null;
$props.$permissions = isset($permissions) ? $permissions : Permission::all();

if (Route::currentRouteName() == 'permissions.index') {
    $props.$has_header = false;
    $props.$title = 'Permissions';
    $props.$modelType = 'Permission';
    $props.$modelId = null;    
}

$has_header = $props.$has_header;
$title = $props.$title;
$cr = $props.$cr;
$modelType = $props.$modelType;
$modelId = $props.$modelId;
$permissions = $props.$permissions; 

?>
@if($has_header)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>
    @endif

    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-3 py-3">Name</th>
                    @if(!$has_header)
                    <th scope="col" class="px-3 py-3">Slug</th>
                    @endif
                    @if($has_header)
                    <th scope="col" class="px-3 py-3">Description</th>
                    @endif
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)

                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-3 py-2">{{ $permission->name?? $permission->display_name }}</td>

                    @if(!$has_header)
                    <td class="px-3 py-2">{{ $permission->slug==='/'? '/' . $permission->name : $permission->slug }}
                    </td>
                    @endif

                    @if($has_header)
                    <td class="px-3 py-2">{{ $permission->description ?? '' }}</td>
                    @endif

                    <td class="px-3 py-2">
                        <a href="{{ route('permissions.edit', $permission) }}"
                            class="text-blue-500 hover:text-blue-700">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        @if(!$has_header)
                        <a href="{{ route('delete.confirmation', ['modelType' => 'Permission', 'modelId' => $permission->id]) }}"
                            class="text-red-500 hover:text-red-700">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($has_header)
</x-app-layout>
@endif