<?php

namespace App\Services\FormElement;

class Element
{
    private $element;

    private $name;
    private $type;
    private $max_length;
    private $value;
    private $label;
    private $options = [];

    public function __construct(string $element)
    {
        $this->element = $element;
    }

    /**
     * SETS
     */

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setMaxLength(int $maxLength): void
    {
        $this->max_length = $maxLength;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * METHODS
     */

    public function render()
    {
        $data = [
            'name'       => $this->name,
            'type'       => $this->type,
            'max_length' => $this->max_length,
            'label'      => $this->label,
            'value'      => $this->value,
            'options'    => $this->options,
        ];

        return view("system.form-element.elements.{$this->element}", $data)->render();
    }
}
