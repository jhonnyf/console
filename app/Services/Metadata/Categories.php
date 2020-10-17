<?php

namespace App\Services\Metadata;

use App\Services\Metadata\Interfaces\RulesInterface;

abstract class Categories implements RulesInterface
{
    public static function tableRules(array $columns): array
    {
        return $columns;
    }

    public static function formRules(array $columns, array $formValues = []): array
    {
        $columns = Metadata::formRulesMain($columns, $formValues);

        $columns['category']['required'] = true;

        return $columns;
    }
}
