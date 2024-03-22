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

$panelsData = [
    'rolesCollection' => [
        'name' => 'Roles',
        'tableName' => 'roles',
        'modelType' => 'Role',
        'modelInstances' => $roles,
    ],
    'permissionsCollection' => [
        'name' => 'Permissions',
        'tableName' => 'permissions',
        'modelType' => 'Permission',
        'modelInstances' => $permissions,
    ],
    'usersCollection' => [
        'name' => 'Users',
        'tableName' => 'users',
        'modelType' => 'User',
        'modelInstances' => $users,
    ],
    'postsCollection' => [
        'name' => 'Posts',
        'tableName' => 'posts',
        'modelType' => 'Post',
        'modelInstances' => $posts,
    ],
    'categoriesCollection' => [
        'name' => 'Categories',
        'tableName' => 'categories',
        'modelType' => 'Category',
        'modelInstances' => $categories,
    ],
    'tagsCollection' => [
        'name' => 'Tags',
        'tableName' => 'tags',
        'modelType' => 'Tag',
        'modelInstances' => $tags,
    ],
    'commentsCollection' => [
        'name' => 'Comments',
        'tableName' => 'comments',
        'modelType' => 'Comment',
        'modelInstances' => $comments,
    ],
    'repliesCollection' => [
        'name' => 'Replies',
        'tableName' => 'replies',
        'modelType' => 'Reply',
        'modelInstances' => $replies,
    ],
    'settingsCollection' => [
        'name' => 'Settings',
        'tableName' => 'settings',
        'modelType' => 'Setting',
        'modelInstances' => $settings,
    ]
];
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
            @if (empty($panelsData))
            <p>No collection to display</p>
            @endif
            <div class="grid grid-cols-3 gap-4">
                @foreach ($panelsData as $field => $mode)
                    @php 
                        $modelInstances = $mode['modelInstances']; 
                        $modelType= $mode['modelType']; 
                        $count = $modelInstances->count(); 
                    @endphp
                    @if($count === 0)
                    <div class="text-center py-10">
                        <h2 class="font-semibold text-sm text-warning leading-tight">
                            {{ __('No ' . $modelType . ' Found') }}
                        </h2>
                    </div>
                    @endif
                    @if($count > 0)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" x-data="{ open: true }">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" @click="open = !open">
                                {{ strToUpper($modelType) }}
                                <button class="float-right">
                                    <span x-show="open">-</span>
                                    <span x-show="!open">+</span>
                                </button>
                            </h3>
                        </div>
                        <div x-show="open" class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    @livewire('model-instances-table', ['modelType' => $modelType,'modelInstances'=>$modelInstances,'tableName' => $mode['tableName'],'has_header' => $has_header])
                                </div>
                            </dl>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>