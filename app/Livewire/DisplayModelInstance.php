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



    public function mount($instanceModel, $modelType, $modelId)
    {
        $this->instanceModel = $instanceModel;
        $this->modelId = $modelId;
        $this->modelType = $modelType;

        $this->instanceModel->fill($this->instanceModel->find($this->modelId)->toArray());
        $this->data = $this->instanceModel->toArray();
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
