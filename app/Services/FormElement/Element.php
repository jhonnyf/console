<?php

namespace App\Services\FormElement;

use Closure;

class Element
{
    private $element;
    private $name;
    private $type;

    public function __construct(string $element)
    {
        $this->element = $element;
    }

    /**
     * SETS
     */

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * METHODS
     */

    public function render()
    {
        $data = [
            'name' => $this->name,
            'type' => $this->type,
        ];

        return view("system.form-element.elements.{$this->element}", $data)->render();
    }
}
