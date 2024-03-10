<div>
    <!-- An unexamined life is not worth living. - Socrates -->
    Hi, {{ Auth::user()->name }}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <x-table :users="$users" />
</div>
