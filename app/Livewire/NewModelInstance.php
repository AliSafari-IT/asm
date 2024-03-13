<?php

namespace App\Livewire;

use Livewire\Component;
// Adjust based on your actual model

class NewModelInstance extends Component
{
    public $permissionModel; // This will hold your model data for binding
    public $instance;
    protected $rules = [
        'permissionModel.*' => 'required', // Example rule, adjust according to your model's attributes
    ];
    public $data = [];

    public function mount($permissionModel)
    {
        $this->permissionModel = $permissionModel;

        $this->instance = $this->permissionModel;

        $this->instance->fill($this->permissionModel->initialValues);
        $this->instance->created_by = auth()->user()->id;
        $this->instance->updated_by = auth()->user()->id;
        $this->instance->created_at = now();
        $this->instance->updated_at = now();
        $this->data = $this->instance->toArray();
    }

    public function save()
    {

        // Handle new logic
        $rules = $this->permissionModel->getRules();
        $messages = $this->permissionModel->getMessages();
        $this->instance->fill($this->data);
        // Validate the nested 'data' structure
        $validatedData = $this->validate([
            'data' => $rules,
        ], $messages);

        // Save logic here, e.g.,
        $this->instance->save();
        \dd($this->instance);
        // Redirect or emit event after save
        return redirect()->route('permissions.index')->with('message', 'Permission created successfully.');
    }

    // Update the data property
    public function updateData($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function render()
    {
        return view('livewire.new-model-instance');
    }
}
