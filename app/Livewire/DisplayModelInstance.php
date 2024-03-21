<?php

namespace App\Livewire;

use Livewire\Component;

class DisplayModelInstance extends Component
{

    public $instanceModel;
    public $modelId;
    public $data = [];
    public $modelType;
    public $fieldTypes;
    public $initialValues;
    public $attributes = [];



    public function mount($instanceModel, $modelType, $modelId)
    {
        $this->instanceModel = $instanceModel;
        $this->modelId = $modelId;
        $this->modelType = $modelType;
        $fieldTypes = $instanceModel->fieldTypes;
        $initialValues = $instanceModel->initialValues;


        foreach($fieldTypes as $field => $type) {
            $this->data[$field] = $instanceModel->$field;
        }
        $data['id'] = $modelId;
        $data['name'] = $instanceModel->name;
        $data['description'] = $instanceModel->description;

        $this->data = $data;
        dd($this->data);

        // add attributes to $data
        $this->data['fields'] = json_decode($fields);
        dd($this->instanceModel);
    }

    // routeToEdit
    public function routeToEdit()
    {
        $modelType = $this->modelType;
        $modelTypeLower = strtolower($modelType);
        $routeTo = $modelTypeLower .'s.edit';
        $modelId = $this->modelId;
        $instanceModel = $this->instanceModel;
        $modelTypeLower = $instanceModel->id;
//<a href="{{ route($modelTypeLower . '.edit', ['id' => $instance['id']]) }}"

        return redirect()->route($routeTo, $instanceModel->id);
    }



    public function render()
    {
        return view('livewire.display-model-instance');
    }
}
