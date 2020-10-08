<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormFields extends Component
{
    public $formFields;
    public $id;
    public $route;
    public $requestData;

    public function __construct($formFields, $id, $route, $requestData)
    {
        $this->formFields   = $formFields;
        $this->id           = $id;
        $this->route        = $route;
        $this->requestData = $requestData;
    }

    public function render()
    {
        return view('components.form-fields');
    }
}
