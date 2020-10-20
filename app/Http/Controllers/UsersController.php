<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersStore;
use App\Http\Requests\UsersUpdate;
use App\Models\Categories;
use App\Models\Users as Model;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct(Model::class);

        $this->Route     = 'users';
        $this->TableName = 'users';
    }

    public function store(UsersStore $request)
    {
        $create = $request->all();

        if (empty($create['password']) === false) {
            $create['password'] = Hash::make($create['password']);
        } else {
            unset($create['password']);
        }

        $response = Model::create($create);

        return redirect()->route("{$this->Route}.form", ['id' => $response->id]);
    }

    public function update(int $id, UsersUpdate $request)
    {
        $fill = $request->all();

        if (empty($fill['password']) === false) {
            $fill['password'] = Hash::make($fill['password']);
        } else {
            unset($fill['password']);
        }

        Model::find($id)->fill($fill)->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id]);
    }

    /**
     * EXTRA
     */

    public function category(int $id)
    {
        $data = [
            'id'         => $id,
            'route'      => $this->Route,
            'categories' => Categories::find(2),
        ];

        return view('users.category', $data);
    }

    public function categoryStore(int $id)
    {
        # code...
    }
}
