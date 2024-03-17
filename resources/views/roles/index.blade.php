<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Roles') }}
    </h2>
</x-slot>
<x-top-menu-container name="headerActions" class="m-6 w-8/12 mx-auto mt-10">
    <x-create-new-button route="roles.create" text="Add New Role" />
</x-top-menu-container>

<x-roles-table :roles="$roles" />

</x-app-layout>