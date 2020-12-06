<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUpload;
use App\Models\FilesGalleries;
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

        $data['filesGalleries'] = FilesGalleries::where(['active' => 1, 'module' => $module])->get();

        return view('files.list-galleries', $data);
    }

    public function uploadForm(string $module, int $link_id, int $file_gallery_id)
    {
        $data = [
            'module'          => $module,
            'link_id'         => $link_id,
            'file_gallery_id' => $file_gallery_id,
        ];

        $response = [
            'error'   => false,
            'message' => 'sucesso',
            'result'  => view('files.upload-form', $data)->render(),
        ];

        return response()->json($response);
    }

    public function submitFiles(string $module, int $link_id, int $file_gallery_id, FileUpload $request)
    {

        if ($request->hasFile('file')) {

            // $request->file('file')->getCl
            
            // $document->getClientOriginalName();
            // $document->getClientOriginalExtension();
            // $document->getSize();
            // $document->getMimeType();

            $response = $request->file->store('uploads');            
            
        }

    }

}
