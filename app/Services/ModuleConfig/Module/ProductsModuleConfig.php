<?php

namespace App\Services\ModuleConfig\Module;

use App\Services\ModuleConfig\AbstractModuleConfig;
use Illuminate\Http\Request;

class ProductsModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'products';
    public $TableName = 'products';
    public $Name      = 'Produto';

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route("{$this->Route}.form", ['id' => $id]),
        ];

        return $response;
    }
}