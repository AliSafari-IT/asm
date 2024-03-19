<div>
    @php
    $currentLocationUrl = url()->current();
    $has_header = (strpos($currentLocationUrl, 'permissions') !== false && strpos($currentLocationUrl, 'create') ===
    false);

    $modelType = 'Permission';
    $permissions = \App\Models\Permission::all();
    @endphp

    @if($has_header)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permissions') }}
            </h2>
        </x-slot>
        <x-top-menu-container name="headerActions" class="m-6 w-8/12 mx-auto mt-10">
            <x-create-new-button route="permissions.create" text="Add New {{ $modelType }}" />
        </x-top-menu-container>
        <x-permissions-table />
    </x-app-layout>
    @endif



    @if(!$has_header)
    @if($permissions->count() > 0)
    @livewire('model-instances-table', ['modelInstances' => $permissions, 'modelType' => $modelType])
    @else
    <div class="text-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('No Permissions Found') }}
        </h2>
    </div>
    @endif
    @endif

</div>