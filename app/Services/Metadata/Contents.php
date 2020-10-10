<?php

namespace App\Services\Metadata;

use App\Services\Metadata\Interfaces\RulesInterface;

abstract class Contents implements RulesInterface
{
    public static function tableRules(array $columns): array
    {
        return $columns;
    }

    public static function formRules(array $columns, array $formValues = []): array
    {
        $columns = Metadata::formRulesMain($columns, $formValues);

        $columns['title']['required'] = true;
        $columns['slug']['readonly']  = true;
        $columns['content']['type']   = 'textarea';

        return $columns;
    }

}
