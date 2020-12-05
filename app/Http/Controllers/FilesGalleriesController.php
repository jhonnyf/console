<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilesGalleriesStore;
use App\Http\Requests\FilesGalleriesUpdate;
use App\Models\FilesGalleries as Model;

class FilesGalleriesController extends Controller
{
    public function __construct()
    {
        $this->Route = 'filesGalleries';
        parent::__construct(Model::class);
    }

    public function store(FilesGalleriesStore $request)
    {
        $response = Model::create($request->all());

        return redirect()->route("{$this->Route}.form", ['id' => $response->id]);
    }

    public function update(int $id, FilesGalleriesUpdate $request)
    {
        Model::find($id)->fill($request->all())->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id]);
    }

}
