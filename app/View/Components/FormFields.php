<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormFields extends Component
{
    public $formFields;
    public $formValues;

    public function __construct($formFields, $formValues)
    {
        $this->formFields = $formFields;
        $this->formValues = $formValues;
    }

    public function render()
    {
        return view('components.form-fields');
    }
}
