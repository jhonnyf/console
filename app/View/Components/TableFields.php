<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableFields extends Component
{
    public $list;
    public $tableFields;
    public $route;

    public function __construct($tableFields, $list, $route)
    {
        $this->list        = $list;
        $this->tableFields = $tableFields;
        $this->route       = $route;
    }

    public function render()
    {
        return view('components.table-fields');
    }
}
