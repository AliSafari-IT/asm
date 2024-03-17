<x-app-layout>
    @php
    $roleId = $role->id;
    @endphp

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Role: '.$role->name) }}
        </h2>
    </x-slot>
    @component('layouts.toolbar')
        @slot('actions')
        <a href="{{ route('roles.index') }}" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
        <a href="{{ route('roles.show', [$role]) }}" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Show</a>
        <a href="{{ route('delete.confirmation', ['modelType' => 'Role', 'modelId' => $role->id]) }}" class="ml-4 text-red-500 hover:text-red-700">Delete</a>
        @endslot
    @endcomponent

    @livewire('edit-model-instance', ['instanceModel' => $role, 'modelType' => 'Role', 'modelId' => $roleId])

</x-app-layout>
