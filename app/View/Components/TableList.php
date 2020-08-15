<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableList extends Component
{
    public $list;

    public function __construct($list)
    {
        $this->list = $list;
    }

    public function render()
    {
        return view('components.table-list');
    }
}
