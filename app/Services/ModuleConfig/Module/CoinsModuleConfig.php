<?php

namespace App\Services\ModuleConfig\Module;

use App\Services\ModuleConfig\AbstractModuleConfig;
use Illuminate\Http\Request;

class CoinsModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'coins';
    public $TableName = 'coins';
    public $Name      = 'Moeda';

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('coins.form', ['id' => $id]),
        ];

        return $response;
    }
}