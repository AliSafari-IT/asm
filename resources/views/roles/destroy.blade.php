<!-- destroy.blade.php -->
<x-app-layout>
    <div>
        @livewire('delete-model-instance', ['modelType' => 'Role', 'modelId' => $modelId])
    </div>
</x-app-layout>
