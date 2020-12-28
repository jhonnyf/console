<?php

namespace App\Services\ModuleConfig\Module;

use App\Services\ModuleConfig\AbstractModuleConfig;
use Illuminate\Http\Request;

class LanguagesModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'languages';
    public $TableName = 'languages';
    public $Name      = 'Linguagem';

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('languages.form', ['id' => $id]),
        ];

        return $response;
    }
}