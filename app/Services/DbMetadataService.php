<?php

namespace App\Services;

class DbMetadataService
{
    public static function fields(array $fields): array
    {
        foreach ($fields as $key => $field) {

            $max_length   = null;
            $position_int = strpos($field->Type, "(");
            if ($position_int !== false) {

                preg_match('/[^a-z]+/', $field->Type, $matches);

                $max_length = str_replace('(', '', $matches[0]);
                $max_length = str_replace(')', '', $max_length);
            }

            $metadata[$key]['name']       = $field->Field;
            $metadata[$key]['type']       = $position_int === false ? $field->Type : substr($field->Type, 0, $position_int);
            $metadata[$key]['max_length'] = trim($max_length);
            $metadata[$key]['key']        = strtolower($field->Key);
        }

        return $metadata;
    }
}
