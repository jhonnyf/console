<?php

namespace App\Services\Metadata;

use App\Services\Metadata\Interfaces\RulesInterface;

class UsersTypes implements RulesInterface
{
    /**
     * @param array $columns
     * @return array
     */

    public static function tableRules(array $columns): array
    {
        $fields = [];

        foreach ($columns as $column) {

            $fields[] = $column;
        }

        return $fields;
    }

    /**
     * @param array $columns
     * @return array
     */

    public static function formRules(array $columns): array
    {
        $fields = Metadata::formRulesMain($columns);

        return $fields;
    }

}
