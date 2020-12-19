<?php

namespace App\Services\ModuleConfig\Module;

use App\Services\ModuleConfig\AbstractModuleConfig;
use Illuminate\Http\Request;

class FilesGalleriesModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'filesGalleries';
    public $TableName = 'files_galleries';
    public $Name      = 'Galerias de arquivos';

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('filesGalleries.form', ['id' => $id]),
        ];

        return $response;
    }
}
