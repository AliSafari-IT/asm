<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RolesTable extends Component
{
    public $roles;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {

        $this->roles = \App\Models\Role::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.roles-table');
    }
}
