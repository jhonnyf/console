<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormFields extends Component
{
    public $formFields;
    public $id;

    public function __construct($formFields, $id)
    {
        $this->formFields = $formFields;
        $this->id         = $id;
    }

    public function render()
    {
        return view('components.form-fields');
    }
}
