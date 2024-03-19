<x-app-layout>
    <div>    
    @php
        $newModel = new \App\Models\User();
        $newModel->initialValues = $newModel->getInitialsValues();
        $newModel->fieldTypes = $newModel->getUserFieldTypes();
        $newModel->rules = $newModel->getUserRules();
        $newModel->messages = $newModel->getUserRulesMessages();
        @endphp
    @livewire('create-new-instance', [ 'instanceModel' => $newModel,'modelType' => 'User']);
    </div>
</x-app-layout>