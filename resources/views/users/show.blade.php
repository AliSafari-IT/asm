<x-app-layout>
    @php $modelType = 'User'; $modelId = $user->id;
    @endphp
    <div>       
        @livewire('display-model-instance', ['instanceModel' => $user, 'modelType' => $modelType, 'modelId' => $modelId]);
    </div>
</x-app-layout>