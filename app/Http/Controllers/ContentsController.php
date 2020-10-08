<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Contents as Model;
use Illuminate\Http\Request;

class ContentsController extends Controller
{

    public function __construct()
    {
        parent::__construct(Model::class);
        $this->Route = 'contents';
    }

    public function index(Request $request)
    {
        $category_page = env('CATEGORY_PAGE');
        if (empty($category_page)) {
            abort(500, 'Categoria de conteúdo não definida');
        }

        $category = Categories::find($category_page);

        $data = [];

        $data['pages'] = $category->categorySecondary;
        $data['route'] = $this->Route;

        return view("{$this->Route}.index", $data);
    }

    public function listContents(int $category_id, Request $request)
    {

        $data = [];

        $data['contents'] = '';
        $data['route']    = $this->Route;

        return view("{$this->Route}.list-contents", $data);
    }

}
