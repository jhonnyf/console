<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersStore;
use App\Http\Requests\UsersUpdate;
use App\Models\Users as Model;
use App\Services\Metadata\Metadata;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct(Model::class);
        $this->Route = 'users';
    }

    public function index(Request $request)
    {
        $data           = [];
        $data['search'] = isset($request->search) ? $request->search : '';

        $list = Model::query();

        if (isset($request->search)) {
            $fields = QueryService::fieldsLike('users');
            $list->where(function ($q) use ($fields, $request) {
                foreach ($fields as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search}%");
                }
            });
        }

        $data['tableValues'] = $list->where('active', '<>', 2)
            ->orderBy('id', 'desc')
            ->get();

        $data['tableFields'] = Metadata::tableFields($this->Model->getTable());
        $data['route']       = $this->Route;

        return view("{$this->Route}.index", $data);
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
}
