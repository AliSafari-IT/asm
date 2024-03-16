<x-app-layout>
    @php $modelType = 'Permission'; $modelId = $permission->id; @endphp
    <div>       
        @livewire('display-model-instance', ['instanceModel' => $permission, 'modelType' => $modelType, 'modelId' => $modelId]);
    </div>
</x-app-layout>