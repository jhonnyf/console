<?php

namespace App\Services\Metadata;

use Illuminate\Support\Facades\DB;

class Metadata
{
    /**
     *
     * @param string $tableName
     * @return array
     */

    public static function tableFields(string $tableName): array
    {
        $className = static::createNameClass($tableName);
        $columns   = static::describe($tableName);

        $pathClass = "\App\Services\Metadata\\{$className}";
        $fields    = $pathClass::formRules($columns);

        return $fields;
    }

    /**
     *
     * @param string $tableName
     * @return array
     */

    public static function formFields(string $tableName): array
    {
        $className = static::createNameClass($tableName);
        $columns   = static::describe($tableName);

        $pathClass = "\App\Services\Metadata\\{$className}";
        $fields    = $pathClass::formRules($columns);

        return $fields;
    }

    /**
     *
     * @param string $table
     * @return array
     */

    private static function describe(string $table): array
    {
        $response = DB::select("DESCRIBE {$table};");
        $response = static::fields($response);

        return $response;
    }

    /**
     *
     * @param array $fields
     * @return array
     */

    private static function fields(array $fields): array
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

    /**
     *
     * @param string $tableName
     * @return string
     */

    private static function createNameClass(string $tableName): string
    {
        $className = str_replace('_', ' ', $tableName);
        $className = ucwords($className);
        $className = str_replace(' ', '', $className);

        return $className;
    }
}
