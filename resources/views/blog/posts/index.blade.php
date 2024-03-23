{{-- resources/views/blog/posts/index.blade.php --}}
@php 
$modelType = 'Post';
$posts = \App\Models\Post::all();
$has_header = (strpos(url()->current(), 'posts') !== false && strpos(url()->current(), 'create') === false);
@endphp

<!-- Roles Index -->
@if($has_header)
<x-app-layout>
@else
<div>
@endif
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Posts') }}
    </h2>
</x-slot>
<x-top-menu-container name="headerActions" class="m-6 w-8/12 mx-auto mt-10">
    <x-create-new-button route="posts.create"  text="Add New {{ $modelType }}" />
</x-top-menu-container>

<!-- Roles Table -->
<x-posts-table />
@if($has_header)
</x-app-layout>
@else
</div>
@endif
