<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesStore;
use App\Http\Requests\CategoriesTree;
use App\Http\Requests\CategoriesUpdate;
use App\Models\Categories as Model;
use App\Models\CategoriesCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoriesController extends Controller
{
    public function __construct()
    {
        parent::__construct(Model::class);

        $this->Route     = 'categories';
        $this->TableName = 'categories';
    }

    public function store(CategoriesStore $request)
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

    public function update(int $id, CategoriesUpdate $request)
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

    public function tree(int $id, Request $request)
    {
        $data = ['id' => $id, 'links' => []];

        $links = CategoriesCategories::where('secondary_id', $id)->get();
        if ($links->count() > 0) {
            foreach ($links as $value) {
                $data['links'][] = $value->primary_id;
            }
        }

        $data['categories'] = Model::where('active', 1)->where('id', '<>', $id)->get();
        $data['route']      = $this->Route;

        return view("{$this->Route}.tree", $data);
    }

    public function saveTree(int $id, CategoriesTree $request)
    {
        $data_request = $request->all();

        CategoriesCategories::where('secondary_id', $data_request['secondary_id'])->delete();

        if (isset($data_request['primary_id'])) {
            foreach ($data_request['primary_id'] as $primary_id) {
                $insert = ['primary_id' => $primary_id, 'secondary_id' => $data_request['secondary_id']];

                if (CategoriesCategories::where($insert)->exists() === false) {
                    CategoriesCategories::create($insert);
                }
            }
        }

        return redirect()->route('categories.tree', ['id' => $id]);
    }
}
