<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersTypesStore;
use App\Http\Requests\UsersTypesUpdate;
use App\Models\UsersTypes as Model;

class UsersTypesController extends Controller
{
    public function __construct()
    {
        parent::__construct(Model::class);

        $this->Route     = 'usersTypes';
        $this->TableName = 'users_types';
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
