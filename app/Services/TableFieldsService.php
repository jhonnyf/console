<?php

namespace App\Services;

class TableFieldsService
{
    public static function format(object $row, array $column): ?string
    {
        $value = '';

        $parameter = isset($column['parameter']) ? $column['parameter'] : $column['name'];

        if (strpos($parameter, "->")) {
            foreach (explode("->", $parameter) as $property) {
                $row = static::getProperty($property, $row);
            }

            $value = $row;
        } else {
            $value = $row->$parameter;
        }

        return $value;
    }

    private static function getProperty($property, $object)
    {
        return $object->{$property};
    }
}
