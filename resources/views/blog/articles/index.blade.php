@php
$modelType = 'Article';
$columns=['id' => 'ID', 'title' => 'Title', 'slug' => 'Slug', 'body'=> 'Content'];
$models = "\\App\Models\\$modelType"::all();
$tableName = strtolower(Str::plural($modelType));
$modelsCreateRoute = $tableName.'.create';
$has_header = (strpos(url()->current(), $tableName) !== false && strpos(url()->current(), 'create') === false);
@endphp

<!-- Conditional Layout -->
@if($has_header)
<x-app-layout>
    @else
    <div>
        @endif
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($modelType . 's') }}
            </h2>
        </x-slot>
        <x-top-menu-container name="headerActions" class="m-6 w-8/12 mx-auto mt-10">
            <x-create-new-button :route="$modelsCreateRoute" :text="'Add New ' . $modelType" />
        </x-top-menu-container>

        <!-- Models Table -->
        <x-show-models :models="$models" :modelType="$modelType" :columns="$columns" :tableName="$tableName" />

        @if($has_header)
</x-app-layout>
@else
</div>
@endif