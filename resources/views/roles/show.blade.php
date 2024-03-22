<x-app-layout>
    @php $modelType = 'Role'; $modelId = $role->id;
        $role = \App\Models\Role::find($modelId);
    @endphp
    <div>       
        @livewire('display-model-instance', ['instanceModel' => $role, 'modelType' => $modelType, 'modelId' => $modelId])
    </div>
    
</x-app-layout>