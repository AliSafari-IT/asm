<?php
namespace App\Livewire;

use Livewire\Component;

class EditModelInstance extends Component
{
    public $instanceModel;
    public $modelId;
    public $data = [];
    public $modelType;

    public function mount($modelType, $modelId, $instanceModel = null)
    {
        $this->instanceModel = $instanceModel;
        $this->modelId = $modelId;
        $this->modelType = $modelType;

        $this->instanceModel->fill($this->instanceModel->find($this->modelId)->toArray());

        $this->data = $this->instanceModel->toArray();
    }

    public function save()
    {

        // Handle new logic
        $rules = $this->instanceModel-> rules;
        $messages = $this->instanceModel-> messages;
        $this->instanceModel->fill($this->data);
        // Validate the nested 'data' structure
        $validatedData = $this->validate([
            'data' => $rules,
        ], $messages);
        $routeTo = strtolower($this->modelType) . 's.index';
        // Save logic here, e.g., display success message
        $this->instanceModel->save();
        return redirect()->route($routeTo)->with('message', 'Permission updated successfully.');       
    }

    public function render()
    {
        return view('livewire.edit-model-instance');
    }
}