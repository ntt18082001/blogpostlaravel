<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class MstSelect extends Component
{
    public $table;
    public $displayColumn;
    /**
     * Create a new component instance.
     */
    public function __construct($table, $displayColumn)
    {
        $this->table = $table;
        $this->displayColumn = $displayColumn;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sql = "select id, $this->displayColumn from $this->table order by id desc";
        $data = DB::select($sql);
        return view('components.admin.mst-select')->with('data', $data);
    }
}
