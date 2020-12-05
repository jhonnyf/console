<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FilesController
{

    public function listGalleries(string $module, int $id_link, Request $request)
    {
        $ModuleConfig = App::make("App\Services\ModuleConfig\Module\\" . ucwords($module) . "ModuleConfig");

        $data = [
            'module'  => $module,
            'id_link' => $id_link,
            'nav'     => $ModuleConfig->setNav($request, $id_link),
            'route'   => $ModuleConfig->Route,
            'name'    => $ModuleConfig->Name,
        ];

        return view('files.list-galleries', $data);
    }

}
