<?php

namespace App\Services\Metadata;

use App\Models\Categories;
use App\Services\Metadata\Interfaces\RulesInterface;

abstract class Users implements RulesInterface
{
    public static function tableRules(array $columns): array
    {
        unset($columns['active']);
        unset($columns['password']);

        // $columns['user_type_id']['parameter'] = "userType->user_type";

        return $columns;
    }

    public static function formRules(array $columns, array $formValues = []): array
    {
        $columns = Metadata::formRulesMain($columns, $formValues);

        $options = [];

        $usersTypes = Categories::find(2)->categorySecondary;
        if ($usersTypes->count() > 0) {
            foreach ($usersTypes as $key => $value) {
                $options[] = ['id' => $value->id, 'option' => $value->category];
            }
        }

        // $columns['user_type_id']['type']    = 'select';
        // $columns['user_type_id']['options'] = $options;
        // $columns['user_type_id']['required'] = true;

        $columns['first_name']['required']   = true;
        $columns['email']['required']        = true;
        $columns['document']['required']     = true;

        return $columns;
    }

}
