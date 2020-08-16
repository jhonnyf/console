<?php

namespace App\Services;



class TableListService
{
    /**
     *
     * @param string $tableName
     * @return array
     */

    public static function getTableFields(string $tableName): array
    {
        $fields = [];

        $className = static::createNameClass($tableName);
        $pathClass = "\App\Services\TableList\\" . $className;

       $fields = $pathClass::getFields();       

       print_r($fields);
       exit();

        return $fields;
    }

    /**
     *
     * @param string $tableName
     * @return string
     */

    private static function createNameClass(string $tableName): string
    {
        $className = str_replace('_', ' ', $tableName);
        $className = ucwords($className);
        $className = str_replace(' ', '', $className);

        return $className;
    }
}
