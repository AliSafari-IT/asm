<!-- destroy.blade.php -->
<x-app-layout>
    <div>
        @livewire('delete-model-instance', ['modelType' => 'User', 'modelId' => $modelId])
    </div>
</x-app-layout>
