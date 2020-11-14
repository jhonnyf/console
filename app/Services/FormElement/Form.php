<?php

namespace App\Services\FormElement;

class FormElement
{
    private $action;
    private $autocomplete;
    private $method;

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

    public function render()
    {
        $data = [
            'action'       => $this->action,
            'autocomplete' => $this->autocomplete,
            'method'       => $this->method,
            'row'          => $this->row,
        ];

        return view('system.form-element.render', $data)->render();
    }
}
