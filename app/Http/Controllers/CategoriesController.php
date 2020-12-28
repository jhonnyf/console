<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesStore;
use App\Http\Requests\CategoriesUpdate;
use App\Models\Categories as Model;
use App\Models\CategoriesCategories;
use App\Models\Languages;
use App\Services\FormElement\FormElement;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->Route = 'categories';
        parent::__construct(Model::class);
    }

    public function index(Request $request)
    {
        $data = [
            'route'    => $this->Route,
            'category' => Model::find(1),
        ];

        return view("{$this->Route}.index", $data);
    }

    public function show(int $id)
    {
        $data = [
            'route'    => $this->Route,
            'category' => Model::find($id),
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
                'parent_id' => $data['id'],
                'html'      => view("{$this->Route}.structure", $data)->render(),
            ],
        ];

        return response()->json($response);
    }

    public function store(CategoriesStore $request)
    {
        $create = $request->all();

        $response = Model::create($create);
        if (isset($create['category_id'])) {
            $this->saveLink($create['category_id'], $response->id);
        }

        return redirect()->route("{$this->Route}.form", ['id' => $response->id]);
    }

    public function update(int $id, CategoriesUpdate $request)
    {
        Model::find($id)->fill($request->all())->save();

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

    /**
     * CONTENT
     */

    public function content(int $id, Request $request)
    {
        $data = [
            'id'          => $id,
            'route'       => $this->Route,
            'name'        => $this->Name,
            'nav'         => $this->setNav($request, $id),
            'category_id' => $request->category_id,
            'languages'   => Languages::where('active', '<>', 2),
        ];

        $LanguageDefault = Languages::where('default', true)->first();

        $language_id             = isset($request->language_id) ? $request->language_id : $LanguageDefault->id;
        $data['language_id']     = $language_id;
        $data['languageDefault'] = $LanguageDefault;

        $CategoryContent = Model::find($id)->content->where('language_id', $language_id)->first();
        $data['content'] = $CategoryContent;

        $Form = new FormElement();
        $Form->setAutocomplete(false);
        $Form->setMethod('post');
        $Form->setAction(route('categories.content-update', ['id' => $id]));

        $language_id = $Form->newElement('input');
        $language_id->setName('language_id');
        $language_id->setValue($CategoryContent->language_id);

        $Form->addElement($language_id);

        $title = $Form->newElement('input');
        $title->setName('title');
        $title->setValue($CategoryContent->title);

        $Form->addElement($title);

        $content = $Form->newElement('textarea');
        $content->setName('content');
        $content->setValue($CategoryContent->content);

        $Form->addElement($content);

        $data['form'] = $Form->render($data);

        return view('categories.content', $data);
    }

    public function contentUpdate(int $id, Request $request)
    {
        $CategoryContent = Model::find($id)->content->where('language_id', $request->language_id)->first();

        $CategoryContent->fill($request->all())->save();

        return redirect()->route('categories.content', ['id' => $id, 'language_id' => $request->language_id]);
    }
}
