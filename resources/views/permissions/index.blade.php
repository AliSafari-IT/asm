@php 
$modelType = 'Permission';
$roles = \App\Models\Permission::all();
$has_header = (strpos(url()->current(), 'permissions') !== false && strpos(url()->current(), 'create') === false);
@endphp

<!-- Permissions Index -->
@if($has_header)
<x-app-layout>
@else
<div>
@endif
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Permissions') }}
    </h2>
</x-slot>
<x-top-menu-container name="headerActions" class="m-6 w-8/12 mx-auto mt-10">
    <x-create-new-button route="permissions.create"  text="Add New {{ $modelType }}" />
</x-top-menu-container>

<!--    Permissions Table -->
<x-permissions-table />
@if($has_header)
</x-app-layout>
@else
</div>
@endif