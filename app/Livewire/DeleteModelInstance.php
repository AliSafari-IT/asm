<?php


namespace App\Livewire;

use App\Models\User;
use Illuminate\Session;
use Livewire\Component;

class DeleteModelInstance extends Component
{
    public $modelType;
    public $modelId;

    public function mount($modelType, $modelId)
    {
        $this->modelType = $modelType;
        $this->modelId = $modelId;
    }

    public function delete()
    {
        $modelClass = $this->getModelClass($this->modelType);

        if (!$modelClass) {
            session()->flash('message', 'Invalid model type.');
            return;
        }

        $modelInstance = $modelClass::find($this->modelId);

        if ($modelInstance) {
            $modelInstance->delete();
            redirect()->route(strtolower($this->modelType) . 's.index');
            session()->flash('message', 'Instance deleted successfully.');
            // Redirect or emit an event as needed
        } else {
            session()->flash('message', 'Instance not found.');
        }
    }

    protected function getModelClass($modelType)
    {
        $models = [
            'Permission' => \App\Models\Permission::class,
            // Add other model bindings as necessary
        ];

        return $models[$modelType] ?? null;
    }

    public function getModelId()
    {
        return $this->modelId;
    }

    public function getModelType()
    {
        return $this->modelType;
    }

    public function goBack()
    {
        return redirect()->route(strtolower($this->modelType) . 's.index');
    }

    public function createNew()
    {
        return redirect()->route(strtolower($this->modelType) . 's.create');
    }

    public function render()
    {
        return view('livewire.delete-model-instance');
    }
}
