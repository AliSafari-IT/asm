<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PermissionsTable extends Component
{
    public $permissions;
    public $modelType;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->modelType = 'Permission';
        $this->permissions = \App\Models\Permission::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.permissions-table');
    }
}
