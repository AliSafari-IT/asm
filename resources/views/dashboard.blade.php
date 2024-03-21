<x-app-layout>
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(session()->has('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <!-- Create 3 panels with crud buttons for users, roles, and permissions, and a container under each crud buttons for the table data to be displayed for each of the entities -->
    <div class="container mx-auto px-4 py-7">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full md:w-1/3 px-4 mb-4 md:mb-0">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold">Users</h3>
                    </div>
                    <x-top-menu-container name="headerActions" class="flex justify-end items-baseline my-1 mx-3 py-3">
                        <div class="flex space-x-4">
                            <x-create-new-button route="users.index" text="View All"
                                classes="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded" type="info" />
                            <x-create-new-button route="users.create" text="Add New" target="_blank" type="secondary" />
                        </div>
                    </x-top-menu-container>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-4 mb-4 md:mb-0">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold">Roles</h3>
                    </div>
                    <x-top-menu-container name="headerActions" class="flex justify-end items-baseline my-1 mx-3 py-3">
                        <div class="flex space-x-4">
                            <x-create-new-button route="roles.index" text="View All"
                                classes="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded" type="info" />
                            <x-create-new-button route="roles.create" text="Add New" target="_blank" type="secondary" />
                        </div>
                    </x-top-menu-container>
                                        <!-- Show the permissions table -->
                                        <div>
                        @include('roles.index', ['use_header' => false])
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-4">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold">Permissions</h3>
                    </div>
                    <x-top-menu-container name="headerActions" class="flex justify-end items-baseline my-1 mx-3 py-3">
                        <div class="flex space-x-4">
                            <x-create-new-button route="permissions.index" text="View All"
                                classes="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded" type="info" />
                            <x-create-new-button route="permissions.create" text="Add New" target="_blank"
                                type="secondary" />
                        </div>
                    </x-top-menu-container>

                   
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>