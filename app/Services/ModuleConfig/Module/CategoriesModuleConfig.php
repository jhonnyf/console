<?php

namespace App\Services\ModuleConfig\Module;

use App\Services\ModuleConfig\AbstractModuleConfig;
use Illuminate\Http\Request;

class CategoriesModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'categories';
    public $TableName = 'categories';
    public $Name      = 'Categorias';

    public function setData(Request $request): array
    {
        return ['category_id' => $request->category_id];
    }
}
