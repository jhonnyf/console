<?php

namespace App\Services\ModuleConfig\Module;

abstract class AbstractUsersModuleConfig
{

    public static function configFormElements(array $fields): array
    {
        $response = [];

        $response[] = [$fields['id']];
        $response[] = [$fields['first_name'], $fields['last_name']];
        $response[] = [$fields['email'], $fields['document']];
        $response[] = [$fields['phone'], $fields['cellphone']];

        return $response;
    }
}
