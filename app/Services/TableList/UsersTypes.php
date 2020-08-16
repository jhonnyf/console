<?php

namespace App\Services\TableList;

use App\Models\UsersTypes as Model;

abstract class UsersTypes
{
    public $Model;
    public $tableColumns;

    public function __construct()
    {
        $this->Model = new Model;
        $this->tableColumns = ['a', 'b', 'c'];
    }

    public static function getFields(): array
    {
        $fields = self::$tableColumns;

        return $fields;
    }

}
