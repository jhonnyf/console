<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesStore;
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

    public function index(Request $request)
    {
        $data = [
            'route'    => $this->Route,
            'category' => Model::find(1)
        ];

        return view("{$this->Route}.index", $data);
    }

    public function structure(Request $request)
    {
        $data = [
            'id'       => $request->id,
            'category' => Model::find($request->id),
        ];

        $response = [
            'error'   => false,
            'message' => 'success',
            'result'  => [
                'html' => view("{$this->Route}.structure", $data)->render(),
            ],
        ];

        return response()->json($response);
    }

    public function store(CategoriesStore $request)
    {
        $create = $request->all();

        $response = Model::create($create);
        if (isset($create['id_category'])) {
            $this->saveLink($create['id_category'], $response->id);
        }

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

    private function saveLink(int $primary_id, int $secondary_id): bool
    {
        $response = false;
        CategoriesCategories::where('secondary_id', $secondary_id)->delete();

        $insert = ['primary_id' => $primary_id, 'secondary_id' => $secondary_id];
        if (CategoriesCategories::where($insert)->exists() === false) {
            CategoriesCategories::create($insert);
            $response = true;
        }

        return $response;
    }

    protected function setData(Request $request): array
    {
        return ['id_category' => $request->id_category];
    }
}
