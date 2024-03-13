<!-- destroy.blade.php -->
<x-app-layout>
    <div>
        @livewire('delete-model-instance', ['modelType' => 'Permission', 'modelId' => $modelId])
    </div>
</x-app-layout>
