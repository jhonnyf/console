<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUpload;
use App\Models\Files;
use App\Models\FilesGalleries;
use App\Models\FilesUsers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FilesController
{

    public function listGalleries(string $module, int $id_link, Request $request)
    {
        $ModuleConfig = App::make("App\Services\ModuleConfig\Module\\" . ucwords($module) . "ModuleConfig");

        $data = [
            'module'         => $module,
            'id_link'        => $id_link,
            'nav'            => $ModuleConfig->setNav($request, $id_link),
            'route'          => $ModuleConfig->Route,
            'name'           => $ModuleConfig->Name,
            'filesGalleries' => FilesGalleries::where(['active' => 1, 'module' => $module])->get(),
        ];

        $data['entity'] = Users::find($id_link)->files();

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

        if ($request->hasFile('file') === false) {
            return response()->isInvalid();
        }

        $file = $request->file('file');

        $data = [
            'file_gallery_id' => $file_gallery_id,
            'original_name'   => $file->getClientOriginalName(),
            'extension'       => $file->getClientOriginalExtension(),
            'size'            => round($file->getSize() / 1024 / 1024, 4),
            'mime_type'       => $file->getMimeType(),
        ];

        $data['file_path'] = $request->file->store("public/{$module}");
        $data['file_path'] = str_replace("public/", "", $data['file_path']);

        $response = Files::create($data);
        Files::find($response->id)->fileContent()->create();

        if ($module === 'users') {
            FilesUsers::create(['files_id' => $response->id, 'users_id' => $link_id]);
        }

        return response()->json($response);
    }

}
