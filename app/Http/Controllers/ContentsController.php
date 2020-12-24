<?php

namespace App\Http\Controllers;

use App\Models\CategoriesContents;
use App\Models\Contents as Model;
use App\Models\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentsController extends Controller
{

    public function __construct()
    {
        $this->Route = 'contents';
        parent::__construct(Model::class);
    }

    public function store(Request $request)
    {
        $create = $request->all();

        $create['slug'] = $this->checkSlug($create['title']);

        $response = Model::create($create);

        $languageDefault = Languages::where('active', '<>', 2)
            ->where('default', true)
            ->first();

        $Content              = Model::find($response->id);
        $Content->language_id = $languageDefault->id;
        $Content->save();

        if (isset($create['category_id'])) {
            $link = ['category_id' => $create['category_id'], 'content_id' => $response->id];
            if (CategoriesContents::where($link)->exists() === false) {
                CategoriesContents::create($link);
            }
        }

        $languages = Languages::where('active', '<>', 2)
            ->where('default', false);
        if ($languages->exists()) {
            foreach ($languages->get() as $key => $value) {
                $newContent = $Content->toArray();

                $newContent['language_id'] = $value['id'];
                $newContent['slug']        = $this->checkSlug($newContent['title']);
                $newContent['created_at']  = date('Y-m-d H:i:s');
                $newContent['updated_at']  = date('Y-m-d H:i:s');

                unset($newContent['id']);

                Model::insert($newContent);
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

    private function checkSlug(string $title, int $id = null)
    {
        $slug  = Str::slug($title);
        $check = Model::where('slug', $slug);

        if (is_null($id) === false) {
            $check->where('id', '<>', $id);
        }

        if ($check->exists()) {
            $slug = "{$slug}-" . rand(0, 100);
            return $this->checkSlug($slug, $id);
        }

        return $slug;
    }

}
