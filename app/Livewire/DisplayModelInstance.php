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
    public $tableName;

    public function mount($instanceModel, $modelType, $modelId, $tableName = null)
    {
        $this->instanceModel = $instanceModel;
        $this->modelId = $modelId;
        $this->modelType = $modelType;
        $cname = "\App\Models\\$modelType";
        $this->tableName = (new $cname)->getTable();
        $this->instanceModel = $this->instanceModel->findOrFail($this->modelId);
        $this->data = $this->instanceModel->toArray();
    }

    // routeToEdit
    public function routeToEdit()
    {
        $modelType = $this->modelType;
        $modelTypeLower = strtolower($modelType);
        $routeTo = $modelTypeLower . 's.edit';
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
