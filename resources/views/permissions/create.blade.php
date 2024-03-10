<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <!-- a form to create a new permission -->
        <div title="Create Permission" action="{{ route('permissions.store') }}" buttonText="Create" method="POST">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Permissions') }}
                </h2>
            </x-slot>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">



            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif


        </div>



        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2>Create Permission</h2>

            <a href="{{ route('permissions.index') }}" class="btn btn-primary">Back</a>
            @php 
            $model = new \App\Models\Permission();
            @endphp

            <x-models-form :model="$model" actionType="create" :fields="['name' => ['label' => 'name', 'type' => 'text'], 'description' => ['label' => 'Description', 'type' => 'text']]" />

        </div>

    </div>

</x-app-layout>