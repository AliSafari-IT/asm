{{-- resources/views/roles/create.blade.php --}}
<x-app-layout>
    <div>
        @php
        $newModel = new \App\Models\Role();
        $newModel->initialValues = $newModel->getInitialValues();
        $newModel->fieldTypes = $newModel->getFieldTypes();
        $newModel->rules = $newModel->getRules();
        $newModel->messages = $newModel->getMessages();
        @endphp
        @livewire('create-new-instance', ['instanceModel' => $newModel, 'modelType' => 'Role'])
    </div>
</x-app-layout>