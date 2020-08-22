<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersTypesStore;
use App\Http\Requests\UsersTypesUpdate;
use App\Models\UsersTypes as Model;
use App\Services\Metadata\Metadata;

class UsersTypesController extends Controller
{
    public function __construct()
    {
        parent::__construct(Model::class);
        $this->Route = 'usersTypes';
    }

    public function index()
    {
        $data = [];

        $data['list'] = Model::where('active', '<>', 2)
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        $data['tableFields'] = Metadata::tableFields($this->Model->getTable());
        $data['route']       = $this->Route;

        return view("{$this->Route}.index", $data);
    }

    public function form(int $id = null)
    {
        $data = ['id' => $id];

        $formValues = Model::find($id);
        if ($formValues) {
            $formValues = $formValues->toArray();
        } else {
            $formValues = [];
        }

        $data['formFields'] = Metadata::formFields($this->Model->getTable(), $formValues);
        $data['route']      = $this->Route;

        return view("{$this->Route}.form", $data);
    }

    public function store(UsersTypesStore $request)
    {
        $response = Model::create($request->all());

        return redirect()->route("{$this->Route}.form", ['id' => $response->id]);
    }

    public function update(int $id, UsersTypesUpdate $request)
    {
        Model::find($id)->fill($request->all())->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id]);
    }
}
