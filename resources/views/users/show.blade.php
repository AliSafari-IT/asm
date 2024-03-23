<x-app-layout>
    @php $modelType = 'User'; $modelId = $user->id; $tableName = 'users';
    @endphp
    <div>       
        @livewire('display-model-instance', ['instanceModel' => $user, 'modelType' => $modelType, 'modelId' => $modelId, 'tableName' => $tableName]);
    </div>
</x-app-layout>