<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CategoriesContents;
use App\Models\Contents as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentsController extends Controller
{

    public function __construct()
    {
        parent::__construct(Model::class);

        $this->Route     = 'contents';
        $this->TableName = 'contents';
    }

    public function listCategories(Request $request)
    {
        $category_page = env('CATEGORY_PAGE');
        if (empty($category_page)) {
            abort(500, 'Categoria de conteúdo não definida');
        }

        $category = Categories::find($category_page);

        $data = [
            'pages' => $category->categorySecondary,
            'route' => $this->Route,
        ];

        return view("{$this->Route}.list-categories", $data);
    }

    public function store(Request $request)
    {
        $create = $request->all();

        $create['slug'] = $this->checkSlug($create['title']);

        $response = Model::create($create);

        if (isset($create['category_id'])) {

            $link = ['category_id' => $create['category_id'], 'content_id' => $response->id];
            if (CategoriesContents::where($link)->exists() === false) {
                CategoriesContents::create($link);
            }
        }

        return redirect()->route("{$this->Route}.form", ['id' => $response->id, 'category_id' => $create['category_id']]);
    }

    public function update(int $id, Request $request)
    {
        $fill = $request->all();

        $fill['slug'] = $this->checkSlug($fill['title'], $id);

        Model::find($id)->fill($fill)->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id, 'category_id' => $fill['category_id']]);
    }

    /**
     * EXTRA
     */

    protected function setData(Request $request): array
    {
        return [
            'category_id' => $request->category_id,
        ];
    }

    protected function setCondition(Request $request): array
    {
        $links = CategoriesContents::where('category_id', $request->category_id)
            ->get()
            ->keyBy('content_id')
            ->toArray();

        return [
            'id' => array_keys($links),
        ];
    }

    private function checkSlug(string $title, int $id = null)
    {
        $slug = Str::slug($title);

        $check = Model::where('slug', $slug);

        if (is_null($id) === false) {
            $check->where('id', '<>', $id);
        }

        if ($check->exists() === false) {
            return $slug;
        } else {
            echo 'TEM IGUAL';
            exit();
        }
    }

}
