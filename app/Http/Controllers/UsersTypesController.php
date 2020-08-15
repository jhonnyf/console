<?php

namespace App\Http\Controllers;

use App\Models\UsersTypes;

class UsersTypesController extends Controller
{
    public function index()
    {
        $data = [];

        $data['list'] = UsersTypes::where('active', '<>', 2)
            ->orderBy('id', 'desc')
            ->get();

        return view('usersTypes.index', $data);
    }

    public function form()
    {
        $data = [];

        return view('usersTypes.form', $data);
    }
}
