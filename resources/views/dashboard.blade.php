<?php

$roles = \App\Models\Role::all();
$permissions = \App\Models\Permission::all();
$users = \App\Models\User::all();
$posts = \App\Models\Post::all();
$categories = \App\Models\Category::all();
$tags = \App\Models\Tag::all();
$comments = \App\Models\Comment::all();
$replies = \App\Models\Reply::all();
$settings = \App\Models\Setting::all();

$has_header = false;
$modesCollection = ['roles' => $roles, 'permissions' => $permissions, 'users' => $users, 'posts' , 'categories', 'tags', 'comments', 'replies', 'settings'];
?>
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (empty($modesCollection))
            <p>No modes to display</p>
            @endif
            <div class="grid grid-cols-3 gap-4">
            @foreach ($modesCollection as $field => $mode)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" x-data="{ open: true }">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" @click="open = !open">
                            {{ strToUpper($field) }}
                                <button class="float-right">
                                    <span x-show="open">-</span>
                                    <span x-show="!open">+</span>
                                </button>
                            </h3>
                        </div>
                        <div x-show="open" class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <!-- Panel Content Here -->
                                    Content for panel:
                                        @livewire('model-instances-table', ['modelType' => $field, 'modelInstances' => $mode, 'has_header' => $has_header])
                                </div>
                            </dl>
                        </div>
                    </div>
                    @endforeach
            </div>
            @php
            @endphp
        </div>
        <!-- Create 3 panels with crud buttons for users, roles, and permissions, and a container under each crud buttons for the table data to be displayed for each of the entities -->
        <div class="container mx-auto px-4 py-7">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/3 px-4 mb-4 md:mb-0">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold">Users</h3>
                        </div>
                        <x-top-menu-container name="headerActions"
                            class="flex justify-end items-baseline my-1 mx-3 py-3">
                            <div class="flex space-x-4">
                                <x-create-new-button route="users.index" text="View All"
                                    classes="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded" type="info" />
                                <x-create-new-button route="users.create" text="Add New" target="_blank"
                                    type="secondary" />
                            </div>
                        </x-top-menu-container>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-4 mb-4 md:mb-0">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold">Roles</h3>
                        </div>
                        <x-top-menu-container name="headerActions"
                            class="flex justify-end items-baseline my-1 mx-3 py-3">
                            <div class="flex space-x-4">
                                <x-create-new-button route="roles.index" text="View All"
                                    classes="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded" type="info" />
                                <x-create-new-button route="roles.create" text="Add New" target="_blank"
                                    type="secondary" />
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
                        <x-top-menu-container name="headerActions"
                            class="flex justify-end items-baseline my-1 mx-3 py-3">
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