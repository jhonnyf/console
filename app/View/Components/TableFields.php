<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableFields extends Component
{
    public $tableValues;
    public $tableFields;
    public $route;

    public function __construct($tableFields, $tableValues, $route)
    {
        $this->tableValues = $tableValues;
        $this->tableFields = $tableFields;
        $this->route       = $route;
    }

    public function render()
    {
        return view('components.table-fields');
    }
}
