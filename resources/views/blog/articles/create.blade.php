<x-app-layout>
    <div>
        @php
        $newModel = new /App/Models/Articles();
        $newModel->initialValues = $newModel->getInitialValues();
        $newModel->fieldTypes = $newModel->getFieldTypes();
        $newModel->rules = $newModel->getRules();
        $newModel->messages = $newModel->getRulesMessages();
        @endphp
        @livewire('create-new-instance', [ 'instanceModel' => $newModel, 'modelType' => 'articles'])
    </div>
</x-app-layout>