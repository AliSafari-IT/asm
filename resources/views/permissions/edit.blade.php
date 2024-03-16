<x-app-layout>
    <div>
        @php
            $modelType = 'Permission';
            $modelId = $permission->id;           
        @endphp
        @isset($modelType, $modelId)
            @livewire('edit-model-instance',  ['instanceModel' => $permission, 'modelType' => $modelType, 'modelId' => $modelId]);
        @else
            {{-- Handle the case where variables are not set --}}
            <p>Error: The required parameters are not available.</p>
        @endisset
    </div>
</x-app-layout>
