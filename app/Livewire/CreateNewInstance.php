<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class CreateNewInstance extends Component
{
    public $instanceModel;
    public $modelType;
    public $data = [];
    public $instance;

    public function mount($instanceModel, $modelType)
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        if (!$instanceModel || !$modelType) {
            throw new \InvalidArgumentException('$instanceModel and $modelType are required.');
        }

        $this->instanceModel = $instanceModel;
        $this->modelType = $modelType;

        $instance = $this->instanceModel;

        $this->initializeInstanceProperties($instance);

        // Handle new logic
        // Fill the data with the initial values
        $data = $this->instanceModel;
        $data->fill($instance->initialValues->toArray());
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->created_at = now();
        $data->updated_at = now();

        $this->data = $data->toArray();
        $this->instanceModel = $data;
    }

    private function initializeInstanceProperties($instance)
    {
        if (!method_exists($instance, 'initialValues')) {
            $instance->initialValues = $this->instanceModel->initialModel->initialValues;
        }

        if (!method_exists($instance, 'getFieldTypes')) {
            $instance->fieldTypes = $this->instanceModel->initialModel->fieldTypes;
        }

        if (!method_exists($instance, 'getRules')) {
            $instance->rules = $this->instanceModel->initialModel->rules;
        }

        if (!method_exists($instance, 'validationMessages')) {
            $instance->messages = $this->instanceModel->initialModel->messages;
        }
    }


    public function save()
    {
        // Ensure instanceModel is an actual model instance
        if (!$this->instanceModel) {
            session()->flash('error', 'No instance model provided.');
            return;
        }

        dd($this->instanceModel);

        $rules = method_exists($this->instanceModel, 'getRules')
        ? $this->instanceModel->getRules() ?? ini
        : [];
        $messages = method_exists($this->instanceModel, 'validationMessages')
        ? $this->instanceModel->validationMessages()
        : [];
        try {

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
        } catch (\Throwable $th) {
            // Log the error
            session()->flash('error', 'Validation failed.');
            return Redirect::route('users.create')->with('error', 'Validation failed: ' . $th->getMessage());

        
        }

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
