<?php

namespace App\Livewire;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Session;
use Livewire\Component;
use App\Models\InitialInstance as InitialPermission;

class EditModelInstance extends Component
{

    public $modelType;
    public $modelId;
    public $instance;
    public $initialValues;
    public $modelClass;

    public $data = [];
    public $rules;
    public $messages;
    public $fieldTypes;
    public $defaultValues;
    protected Permission $permissionModel;

    public function __construct()
    {

        $this->permissionModel = new Permission();

        $this->initialValues = $this->permissionModel->initialValues;
        $this->fieldTypes = $this->permissionModel->fieldTypes;
        $this->rules = $this->permissionModel->rules;
        $this->messages = $this->permissionModel->messages;
    }

    public function updateData()
    {
        $this->instance->update($this->data);
        session()->flash('message', $this->modelType . ' instance updated successfully.');
    }

    public function render()
    {
        return view('livewire.edit-model-instance');
    }

    // customize the validation rules
    public function getFieldTypes()
    {
        return $this->fieldTypes;
    }

    // getFieldTypes
    public function getInitialValues()
    {
        return $this->initialValues;
    }

    public function mount($modelType, $modelId = null)
    {
        $this->modelType = $modelType;
        $this->modelId = $modelId;
        $modelClass = '\\App\\Models\\' . $this->modelType;
        $this->modelClass = $modelClass;

        if ($this->modelId) {
            // Editing an existing model instance
            $this->instance = $modelClass::findOrFail($this->modelId);
            $this->data = $this->instance->toArray();
        } else {
            // Preparing to create a new model instance
            $model = $permissionModel ?? new $modelClass;
            $this->instance = $model;
            $this->instance->fill($this->initialValues);
            $this->instance->created_by = auth()->user()->id;
            $this->instance->updated_by = auth()->user()->id;
            $this->instance->created_at = now();
            $this->instance->updated_at = now();

            $this->data = $this->instance->toArray();
        }

    }

    public function save()
    {

        $rules = $this->rules;
        $messages = $this->messages;
        $modelClass = '\\App\\Models\\' . $this->modelType;
        $this->modelClass = $modelClass;

        // Validate the nested 'data' structure
        $validatedData = $this->validate([
            'data.*' => $rules,
        ], $messages);

        // Handle new vs. update logic
        if (!$this->modelId) {
            // Creating a new instance
            $this->instance = new $modelClass;
            $this->defaultValues = $this->instance->defaultValues();
            $this->instance->fill($this->defaultValues);
            $this->instance->created_by = auth()->user()->id;
            $this->instance->updated_by = auth()->user()->id;
            $this->instance->created_at = now();
            $this->instance->updated_at = now();
            $this->instance->fill($this->instance->defaultValues());
        }

        // Assuming $this->data is structured correctly for your model
        $this->instance->fill($this->data);
        $this->instance->save();

        // Redirect or flash message
        session()->flash('message', $this->modelType . ' instance saved successfully.');
        return redirect()->route(strtolower($this->modelType) . 's.index');
    }

    public function delete()
    {
        $this->instance->destroy($this->modelId);
        session()->flash('message', $this->modelType . ' instance deleted successfully.');
    }

    public function cancel()
    {
        session()->flash('message', $this->modelType . ' instance not saved.');
    }

    // customize the validation messages
    public function getMessages()
    {
        return $this->messages;
    }

    // customize the validation rules
    public function getRules()
    {
        return $this->rules;
    }

    // customize the default values
    public function getDefaultData()
    {
        return $this->defaultValues;
    }

    public function updated($propertyName)
    {

        $model = new InitialPermission();
        $this->initialValues = $model->getInitialValues();
        $this->fieldTypes = $model->getFieldTypes();
        $this->rules = $model->getRules();
        $this->messages = $model->getMessages();

        $inst = $this->instance -> fill($this->data);
        $this->data = $inst->toArray();




        $rules = $this->rules;
        
        $this->validateOnly($propertyName, $rules);

    }

}
