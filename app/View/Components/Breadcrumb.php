<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{

    public $id;
    public $route;
    public $name;

    public function __construct(int $id, string $route, string $name = '')
    {
        $this->id    = $id;
        $this->route = $route;
        $this->name = $name;
    }

    public function render()
    {
        return view('components.breadcrumb');
    }
}
