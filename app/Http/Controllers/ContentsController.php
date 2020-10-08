<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Contents as Model;
use App\Services\Metadata\Metadata;
use App\Services\QueryService;
use Illuminate\Http\Request;

class ContentsController extends Controller
{

    public function __construct()
    {
        parent::__construct(Model::class);
        $this->Route = 'contents';
    }

    public function listCategories(Request $request)
    {
        $category_page = env('CATEGORY_PAGE');
        if (empty($category_page)) {
            abort(500, 'Categoria de conteúdo não definida');
        }

        $category = Categories::find($category_page);

        $data = [];

        $data['pages'] = $category->categorySecondary;
        $data['route'] = $this->Route;

        return view("{$this->Route}.list-categories", $data);
    }

    public function index(int $category_id, Request $request)
    {
        $data           = ['category_id' => $category_id];
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

    public function store(Request $request)
    {
        $create = $request->all();

        $response = Model::create($create);

        return redirect()->route("{$this->Route}.form", ['id' => $response->id]);
    }

    public function update(int $id, Request $request)
    {
        $fill = $request->all();

        Model::find($id)->fill($fill)->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id]);
    }

}
