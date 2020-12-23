<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUpload;
use App\Models\Contents;
use App\Models\Files;
use App\Models\FilesGalleries;
use App\Models\FilesUsers;
use App\Models\Users;
use App\Services\FormElement\FormElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FilesController
{

    public function form(int $id)
    {
        $data = [
            'id'       => $id,
            'route'    => 'files',
            'btn_back' => false,
        ];

        $file = Files::find($id)->fileText;

        $form = new FormElement;

        $form->setAction(route('files.form', ['id' => $id]));
        $form->setAutocomplete(false);
        $form->setMethod('post');
        $form->setClass(['form-ajax']);

        $title = $form->newElement('input');
        $title->setName('title');
        $title->setType('text');
        $title->setLabel('Título');
        $title->setValue($file->title);

        $form->addElement($title);

        $content = $form->newElement('textarea');
        $content->setName('content');
        $content->setLabel('Conteúdo');
        $content->setValue($file->content);

        $form->addElement($content);

        $data['form'] = $form->render($data);

        $response = [
            'error'   => false,
            'message' => 'sucesso',
            'result'  => view('files.form', $data)->render(),
        ];

        return response()->json($response);
    }

    public function update(int $id, Request $request)
    {
        $response = Files::find($id)->fileText->fill($request->all())->save();

        $data = [
            'class'   => $response ? 'success' : 'danger',
            'message' => $response ? 'Ação realizada com sucesso' : 'Não foi possivel realizar a ação',
        ];

        $response = [
            'error'   => $response,
            'message' => view('system.alert', $data)->render(),
            'result'  => Files::with('fileText')->find($id),
        ];

        return response()->json($response);
    }

    public function listGalleries(string $module, int $link_id, Request $request)
    {
        $ModuleConfig = App::make("App\Services\ModuleConfig\Module\\" . ucwords($module) . "ModuleConfig");

        $data = [
            'module'         => $module,
            'link_id'        => $link_id,
            'nav'            => $ModuleConfig->setNav($request, $link_id),
            'route'          => $ModuleConfig->Route,
            'name'           => $ModuleConfig->Name,
            'filesGalleries' => FilesGalleries::where(['active' => 1, 'module' => $module])
                ->orWhere(function ($q) {
                    $q->where('module', null)->orWhere('module', "");
                })
                ->get(),
        ];

        if ($module == 'users') {
            $data['entity'] = Users::find($link_id)
                ->files()
                ->where('active', '<>', 2);
        } elseif ($module == 'contents') {
            $data['entity'] = Contents::find($link_id)
                ->files()
                ->where('active', '<>', 2);
        }

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
        Files::find($response->id)->fileText()->create();

        if ($module === 'users') {
            FilesUsers::create(['files_id' => $response->id, 'users_id' => $link_id]);
        }

        return response()->json($response);
    }

    public function active(int $id)
    {
        $Object = Files::find($id);

        $Object->active = $Object->active === 1 ? 0 : 1;
        $Object->save();

        return redirect()->back();
    }

    public function destroy(int $id)
    {
        $Object = Files::find($id);

        $Object->active = 2;
        $Object->save();

        return redirect()->back();
    }

}
