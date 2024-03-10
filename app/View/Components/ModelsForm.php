<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModelsForm extends Component
{
    public $model;
    public $actionType;
    public $fields;

    /**
     * Create a new component instance.
     *
     * @param mixed $model
     * @param string $actionType
     * @param array $fields
     */
    public function __construct($model = null, $actionType = 'create', $fields = [])
    {
        $this->model = $model;
        $this->actionType = $actionType;
        $this->fields = $fields;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.models-form');
    }
}
