<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersTypesStore;
use App\Http\Requests\UsersTypesUpdate;
use App\Models\Users as Model;
use App\Services\Metadata\Metadata;
use App\Services\QueryService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct(Model::class);
        $this->Route = 'usersTypes';
    }

    public function index(Request $request)
    {
        $data           = [];
        $data['search'] = isset($request->search) ? $request->search : '';

        $list = Model::query();

        if (isset($request->search)) {
            $fields = QueryService::fieldsLike('users_types');
            $list->where(function ($q) use ($fields, $request) {
                foreach ($fields as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search}%");
                }
            });
        }

        $data['list'] = $list->where('active', '<>', 2)
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        $data['tableFields'] = Metadata::tableFields($this->Model->getTable());
        $data['route']       = $this->Route;

        return view("{$this->Route}.index", $data);
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
