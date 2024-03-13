<!-- delete-model-instance.blade.php for the Livewire component possition at  middle of the page. -->

<x-modal name="delete-confirmation" :show="true" maxWidth="2xl">
    <!-- Component content goes here -->
    <h1 class="text-xl font-bold mb-4 p-8">Delete Confirmation</h1>

    <p class="p-8">Are you sure you want to delete this {{ $modelType }}?</p>
    <x-primary-button wire:click="createNew" class="p-8 text-white bg-green-500 hover:bg-red-700">
        Add New Instance {{ $modelType }}
    </x-primary-button>
    <x-danger-button wire:click="delete" wire:loading.attr="disabled">
        Confirm Delete
    </x-danger-button>
    <x-secondary-button wire:click="goBack" wire:loading.attr="disabled">
        Cancel Delete
    </x-secondary-button>
</x-modal>