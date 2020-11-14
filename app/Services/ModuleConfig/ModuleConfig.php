<?php

namespace App\Services\ModuleConfig;

use App\Services\FormElement\Element;

class ModuleConfig
{

    public static function formFields(string $tableName, array $fields): array
    {
        $response = [];

        $path     = static::checkClass($tableName);
        $elements = static::createElement($fields);
        $response = $path::configFormElements($elements);

        return $response;
    }

    public static function checkClass(string $className): string
    {
        $className = ucwords(mb_strtolower($className));
        $path      = "\App\Services\ModuleConfig";

        if (file_exists(app_path("Services/ModuleConfig/Module/Abstract{$className}ModuleConfig.php"))) {
            $path = "\App\Services\ModuleConfig\Module\\Abstract{$className}ModuleConfig";
        }

        return $path;
    }

    public static function createElement(array $fields)
    {
        $elements = [];

        foreach ($fields as $key => $field) {
            $element = new Element($field['element']);

            $element->setName($field['name']);
            $element->setType($field['type']);
            $element->setMaxLength($field['max_length']);
            $element->setValue($field['value']);

            $elements[$key] = $element;
        }

        return $elements;
    }
}
