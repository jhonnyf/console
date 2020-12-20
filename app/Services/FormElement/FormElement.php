<?php

namespace App\Services\FormElement;

class FormElement
{
    private $action;
    private $autocomplete;
    private $method;
    private $class;

    private $row       = [];
    private $totalRows = 0;

    /**
     * SETS
     */

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function setAutocomplete(bool $autocomplete): void
    {
        $this->autocomplete = $autocomplete ? 'on' : 'off';
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function setClass(array $class): void
    {
        $this->class = $class;
    }

    /**
     * METHODS
     */

    public function newRow(): void
    {
        $this->totalRows++;
        $this->row[$this->totalRows] = [];
    }

    public function newElement(string $element)
    {
        return new Element($element);
    }

    public function addElement(Element $element)
    {
        $this->row[$this->totalRows][] = $element->render();
    }

    public function render(array $extraData = [])
    {
        $data = [
            'action'       => $this->action,
            'autocomplete' => $this->autocomplete,
            'method'       => $this->method,
            'row'          => $this->row,
            'class'        => $this->class,
        ];

        if (count($extraData) > 0) {
            $data = array_merge($data, $extraData);
        }

        return view('system.form-element.render', $data)->render();
    }
}
