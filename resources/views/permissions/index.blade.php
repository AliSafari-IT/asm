<div class="max-w-4xl mx-auto">
    @php
    $has_header = true;
    $title = 'Permissions';

    $cr = '';
    $modelType = 'Permission';
    $modelId = '';
    $permissions = \App\Models\Permission::all();

    if (Route::currentRouteName() === 'dashboard') {
    $title = '';
    $has_header = false;
    $title = 'Permissions';
    $modelId = null;
    }

    @endphp

    @if($has_header)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permissions') }}
            </h2>
        </x-slot>

        @livewire('model-instances-table', ['modelInstances' => $permissions, 'modelType' => $modelType, 'tableName' =>
        'permissions', 'hasHeader' => $has_header])
    </x-app-layout>
    @endif

    @if(!$has_header)
    @livewire('model-instances-table', ['modelInstances' => $permissions, 'modelType' => $modelType])
    @endif

</div>