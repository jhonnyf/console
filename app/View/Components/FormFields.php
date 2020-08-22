<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormFields extends Component
{
    public $formFields;
    public $id;
    public $route;

    public function __construct($formFields, $id, $route)
    {
        $this->formFields = $formFields;
        $this->id         = $id;
        $this->route      = $route;
    }

    public function render()
    {
        return view('components.form-fields');
    }
}
