<?php

namespace App\Http\Controllers;

use App\Models\UsersTypes as Model;
use App\Services\Metadata\Metadata;

class UsersTypesController extends Controller
{
    public function __construct()
    {
        parent::__construct(Model::class);
    }

    public function index()
    {
        $data = [];

        $data['list'] = Model::where('active', '<>', 2)
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        $data['tableFields'] = Metadata::tableFields($this->Model->getTable());

        return view('usersTypes.index', $data);
    }

    public function form(int $id = null)
    {
        $data = [];

        $data['formValues'] = Model::find($id)->toArray();
        $data['formFields'] = Metadata::formFields($this->Model->getTable());

        return view('usersTypes.form', $data);
    }
}
