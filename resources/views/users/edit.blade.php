<x-app-layout>
    <div>
        @php
            $modelType = 'User';
            $modelId = $user->id;
            $user = \App\Models\User::find($user->id);            
            $instanceModel = $user;

        @endphp
        @isset($modelType, $modelId)
            @livewire('edit-model-instance',  ['instanceModel' => $instanceModel, 'modelType' => $modelType, 'modelId' => $modelId]);
        @else
            {{-- Handle the case where variables are not set --}}
            <p>Error: The required parameters are not available.</p>
        @endisset
    </div>
</x-app-layout>