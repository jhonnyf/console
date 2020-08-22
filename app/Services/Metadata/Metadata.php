<?php

namespace App\Services\Metadata;

use Illuminate\Support\Facades\DB;

class Metadata
{

    public static function tableFields(string $tableName): array
    {
        $className = static::createNameClass($tableName);
        $columns   = static::describe($tableName);

        $pathClass = "\App\Services\Metadata\\{$className}";
        $fields    = $pathClass::tableRules($columns);

        return $fields;
    }

    public static function formFields(string $tableName, array $formValues = []): array
    {
        $className = static::createNameClass($tableName);
        $columns   = static::describe($tableName);

        $pathClass = "\App\Services\Metadata\\{$className}";
        $fields    = $pathClass::formRules($columns, $formValues);

        return $fields;
    }

    public static function formRulesMain(array $columns, array $formValues = []): array
    {
        unset($columns['active']);
        unset($columns['created_at']);
        unset($columns['updated_at']);

        $columns = static::formatFields($columns, $formValues);

        return $columns;
    }

    public static function formatFields(array $columns, array $formValues = []): array
    {
        $fields = [];

        $text = ['varchar', 'char'];

        foreach ($columns as $column) {

            $value = isset($formValues[$column['name']]) ? $formValues[$column['name']] : '';

            if ($column['key'] === 'pri') {
                $type = 'hidden';
            } elseif (in_array($column['type'], $text)) {
                $type = 'text';
            } else {
                exit('Tipo não definido');
            }

            $fields[] = ['name' => $column['name'], 'type' => $type, 'max_length' => $column['max_length'], 'value' => $value];
        }

        return $fields;
    }

    private static function describe(string $table): array
    {
        $response = DB::select("DESCRIBE {$table};");
        $response = static::fields($response);

        return $response;
    }

    private static function fields(array $fields): array
    {
        foreach ($fields as $field) {

            $max_length   = null;
            $position_int = strpos($field->Type, "(");
            if ($position_int !== false) {

                preg_match('/[^a-z]+/', $field->Type, $matches);

                $max_length = str_replace('(', '', $matches[0]);
                $max_length = str_replace(')', '', $max_length);
            }

            $metadata[$field->Field]['name']       = $field->Field;
            $metadata[$field->Field]['type']       = $position_int === false ? $field->Type : substr($field->Type, 0, $position_int);
            $metadata[$field->Field]['max_length'] = trim($max_length);
            $metadata[$field->Field]['key']        = strtolower($field->Key);
        }

        return $metadata;
    }

    private static function createNameClass(string $tableName): string
    {
        $className = str_replace('_', ' ', $tableName);
        $className = ucwords($className);
        $className = str_replace(' ', '', $className);

        return $className;
    }

}
