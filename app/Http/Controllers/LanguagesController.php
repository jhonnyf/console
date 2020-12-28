<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguagesStore;
use App\Http\Requests\LanguagesUpdate;
use App\Models\Languages as Model;

class LanguagesController extends Controller
{
    public function __construct()
    {
        $this->Route = 'languages';
        parent::__construct(Model::class);
    }

    public function store(LanguagesStore $request)
    {
        $response = Model::create($request->all());

        return redirect()->route("{$this->Route}.form", ['id' => $response->id]);
    }

    public function update(int $id, LanguagesUpdate $request)
    {
        Model::find($id)->fill($request->all())->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id]);
    }

}
