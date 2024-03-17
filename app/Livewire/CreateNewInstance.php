<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateNewInstance extends Component
{
    public $instanceModel;
    public $modelType;
    public $data = [];

    public function mount($instanceModel, $modelType)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->instanceModel = $instanceModel;
        $this->modelType = $modelType;

        // Handle new logic
        // Fill the data with the initial values
        $data = $this->instanceModel;
        $data->fill($this->instanceModel->initialValues);
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->created_at = now();
        $data->updated_at = now();

        $this->data = $data->toArray();
        $this->instanceModel = $data;
    }

    public function save()
    {
        // Ensure instanceModel is an actual model instance
        if (!$this->instanceModel) {
            session()->flash('error', 'No instance model provided.');
            return;
        }

        $rules = method_exists($this->instanceModel, 'getRules')
        ? $this->instanceModel->getRules()
        : [];
        $messages = method_exists($this->instanceModel, 'validationMessages')
        ? $this->instanceModel->validationMessages()
        : [];

        // Conditionally convert each rule's key to start with 'data.' if it doesn't already
        $prefixedRules = collect($rules)->mapWithKeys(function ($rule, $key) {
            // Prepend 'data.' only if it's not already there
            if (!str_starts_with($key, 'data.')) {
                $key = "data.$key";
            }
            return [$key => $rule];
        })->toArray();

        // Validate the data
        $this->validate($prefixedRules, $messages);

        // Fill and save the model
        $this->instanceModel->fill($this->data);
        $this->instanceModel->save();

        // Redirect or emit event after save
        session()->flash('success', $this->modelType . ' created successfully.');
        return redirect()->route(strtolower($this->modelType) . 's.index');
    }

    public function render()
    {
        return view('livewire.create-new-instance');
    }
}