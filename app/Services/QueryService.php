<?php

namespace App\Services;

use App\Services\Metadata\Metadata;

class QueryService
{
    public static function fieldsLike($tables): array
    {
        $tables = is_array($tables) ? $tables : [$tables];
        $fields = [];

        foreach ($tables as $key => $table) {
            $metdata = Metadata::describe($table);
            foreach ($metdata as $key => $column) {
                $fields[] = $column->Field;
            }
        }

        return $fields;
    }
}
