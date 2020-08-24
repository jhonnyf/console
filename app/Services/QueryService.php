<?php

namespace App\Services;

use App\Services\Metadata\Metadata;

class QueryService
{
    public static function fieldsLike($tables): array
    {
        $tables = is_array($tables) ? $tables : [$tables];
        $fields = [];

        foreach ($tables as $table) {
            $metdata = Metadata::describe($table);
            foreach ($metdata as $column) {
                $fields[] = $column->Field;
            }
        }

        return $fields;
    }
}
