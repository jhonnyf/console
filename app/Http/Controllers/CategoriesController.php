<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesStore;
use App\Http\Requests\CategoriesUpdate;
use App\Models\Categories;
use App\Models\Categories as Model;
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
        $this->saveLink($response->id, $create['category_id']);

        $languages = Languages::where('active', '<>', 2)->orderBy('default', 'desc');
        if ($languages->exists()) {
            $reference_id = null;
            foreach ($languages->get() as $language) {
                $responseContent = Categories::find($response->id)->contents()->create();

                $content = Categories::find($response->id)
                    ->contents()
                    ->where('id', $responseContent->id)
                    ->first();

                $content->language_id = $language->id;
                if (is_null($reference_id) === false) {
                    $content->reference_id = $reference_id;
                }

                $content->save();

                $reference_id = $content->id;
            }
        }

        return redirect()->route("{$this->Route}.form", ['id' => $response->id, 'category_id' => $create['category_id']]);
    }

    public function update(int $id, CategoriesUpdate $request)
    {
        Model::find($id)
            ->fill($request->all())
            ->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id]);
    }

    private function saveLink(int $id, int $category_id): void
    {
        $Category = Categories::find($id);

        $Category->categoryPrimary()->detach();
        $Category->categoryPrimary()->attach($category_id);

        return;
    }

    /**
     * CONTENT
     */

    public function content(int $id, Request $request)
    {
        $data = [
            'id'                     => $id,
            'route'                  => $this->Route,
            'name'                   => $this->Name,
            'nav'                    => $this->setNav($request, $id),
            'category_id'            => $request->category_id,
            'navLanguageRoute'       => 'categories.content',
            'navLanguageRouteParams' => ['id' => $id, 'category_id' => $request->category_id],
        ];

        $LanguageDefault = Languages::where('default', true)->first();

        $language_id             = isset($request->language_id) ? $request->language_id : $LanguageDefault->id;
        $data['language_id']     = $language_id;
        $data['languageDefault'] = $LanguageDefault;

        $CategoryContent = Model::find($id)->contents->where('language_id', $language_id)->first();
        $data['content'] = $CategoryContent;

        $Form = new FormElement();
        $Form->setAutocomplete(false);
        $Form->setMethod('post');
        $Form->setAction(route('categories.content-update', ['id' => $id]));

        $language_id = $Form->newElement('input');
        $language_id->setName('language_id');
        $language_id->setType('hidden');
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
        $CategoryContent = Model::find($id)->contents->where('language_id', $request->language_id)->first();

        $CategoryContent->fill($request->all())->save();

        return redirect()->route('categories.content', ['id' => $id, 'language_id' => $request->language_id]);
    }
}
