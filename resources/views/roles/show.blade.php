<x-app-layout>
    @php $modelType = 'Role'; $modelId = $role->id;
    @endphp
    <div>       
        @livewire('display-model-instance', ['instanceModel' => $role, 'modelType' => $modelType, 'modelId' => $modelId]);
    </div>
</x-app-layout>