<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <!-- Create 3 panels with crud buttons for users, roles, and permissions, and a container under each crud buttons for the table data to be displayed for each of the entities -->
    <div class="container mx-auto px-4">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full md:w-1/3 px-4 mb-4 md:mb-0">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold">Users</h3>
                </div>
                <div class="p-6">
                    <a href="{{ route('users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Users</a>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/3 px-4 mb-4 md:mb-0">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold">Roles</h3>
                </div>
                <div class="p-6">
                    <a href="{{ route('roles.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Roles</a>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/3 px-4">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold">Permissions</h3>
                </div>
                <div class="p-6">
                    <a href="{{ route('permissions.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Permissions</a>
                </div>
            </div>
        </div>
    </div>
</div>


</x-app-layout>
