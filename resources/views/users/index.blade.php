    <x-app-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
        </x-slot>
        <x-top-menu-container name="headerActions" class="m-6 w-8/12 mx-auto mt-10">
            <x-create-new-button route="users.create" text="Add New User" />
        </x-top-menu-container>
        <x-users-table :users="$users" />

    </x-app-layout>