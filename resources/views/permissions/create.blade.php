<x-app-layout>
    <div>    
        @php 

            $title = 'Create Permission';
            $cr = 'permissions/create';
            $permissionModel = new \App\Models\Permission();
            $initialModel = new \App\Models\InitialInstance();
            $permissionModel->initialValues = $initialModel->getInitialValues();
            $permissionModel->fieldTypes = $initialModel->getFieldTypes();
            $permissionModel->rules = $initialModel->getRules();
            $permissionModel->messages = $initialModel->getMessages();


        @endphp
    @livewire('new-model-instance', ['permissionModel' => $permissionModel, 'modelId' => null]);
    </div>
</x-app-layout>