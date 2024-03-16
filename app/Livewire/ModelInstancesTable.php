<?php

namespace App\Livewire;

use Livewire\Component;

class ModelInstancesTable extends Component
{

    public $modelInstances = [];
    public $modelType;
    public $data = [];
    public $hasHeader;
    public $tableName;


    public function mount( $modelInstances, $modelType, $hasHeader = false, $tableName = '')
    {
        $this->modelInstances = $modelInstances;
        $this->modelType = $modelType;
        $this->hasHeader = $hasHeader;
        $this->tableName = $tableName;

        $this->modelInstances = $modelInstances->toArray();
        $this ->data = $this->modelInstances;


    }

    public function render()
    {
        return view('livewire.model-instances-table');
    }
}