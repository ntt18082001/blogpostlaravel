<?php

namespace App\View\Components\Admin;

use App\Models\Role;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MstSelectRole extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $roles = Role::all();
        return view('components.admin.mst-select-role')->with('data', $roles);
    }
}
