<?php

namespace App\Livewire;

use Livewire\Component;

class CreateNewInstance extends Component
{
    public $instanceModel;
    public $instance;
    public $data = [];
    public $initialValues;
    public $fieldTypes;
    public $modelType;

    public function mount($instanceModel, $modelType = null)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $this->modelType = $modelType;
        $this->instanceModel = $instanceModel;
        $this->instance = $this->instanceModel;
        $this->instance->fill($this->instanceModel-> getInitialsValues());
        $this->instance->created_by = auth()->user()->id;
        $this->instance->updated_by = auth()->user()->id;
        $this->instance->created_at = now();
        $this->instance->updated_at = now();
        $this->data = $this->instance->toArray();
    }

    public function save()
    {
        $rules = $this->instanceModel-> rules;
        $messages = $this->instanceModel-> messages;
        $this->instance->fill($this->data);
        // Validate the nested 'data' structure
        $validatedData = $this->validate([
            'data' => $rules,
        ], $messages);
    
        // Save logic here, e.g.,
        $this->instance->save();

        // Redirect or emit event after save
        $routeTo = \strtolower($this->modelType) . 's.index';
        return redirect()->route($routeTo);
    }

    public function render()
    {
        return view('livewire.create-new-instance');
    }
}