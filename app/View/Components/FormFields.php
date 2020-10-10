<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\View\Component;

class FormFields extends Component
{
    public $formFields;
    public $id;
    public $route;
    public $requestData;

    public function __construct($formFields, $id, $route, Request $request)
    {
        $this->formFields  = $formFields;
        $this->id          = $id;
        $this->route       = $route;
        $this->requestData = $request->all();
    }

    public function render()
    {
        return view('components.form-fields');
    }
}
