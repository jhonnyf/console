<?php

namespace App\Services\Metadata;

use App\Models\UsersTypes;
use App\Services\Metadata\Interfaces\RulesInterface;

abstract class Users implements RulesInterface
{
    public static function tableRules(array $columns): array
    {
        unset($columns['active']);
        unset($columns['password']);

        $columns['user_type_id']['parameter'] = "userType->user_type";

        return $columns;
    }

    public static function formRules(array $columns, array $formValues = []): array
    {
        $columns = Metadata::formRulesMain($columns, $formValues);

        $UsersTypes = UsersTypes::where('active', '<>', 2)
            ->select('id', 'user_type as option')
            ->orderBy('user_type', 'asc')
            ->get();

        $columns['user_type_id']['type']    = 'select';
        $columns['user_type_id']['options'] = $UsersTypes;

        $columns['user_type_id']['required'] = true;
        $columns['first_name']['required']   = true;
        $columns['email']['required']        = true;
        $columns['document']['required']     = true;

        return $columns;
    }

}
