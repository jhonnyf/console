<?php

namespace App\Services\Metadata;

use App\Services\Metadata\Interfaces\RulesInterface;

abstract class UsersTypes implements RulesInterface
{

    public static function tableRules(array $columns): array
    {
        $fields = [];

        foreach ($columns as $column) {

            $fields[] = $column;
        }

        return $fields;
    }

    public static function formRules(array $columns, array $formValues = []): array
    {
        return Metadata::formRulesMain($columns, $formValues);
    }

}
