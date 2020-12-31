<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsStore;
use App\Http\Requests\ProductsUpdate;
use App\Models\Languages;
use App\Models\Products as Model;
use App\Services\FormElement\FormElement;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->Route = 'products';
        parent::__construct(Model::class);
    }

    public function store(ProductsStore $request)
    {
        $response = Model::create($request->all());

        $languages = Languages::where('active', '<>', 2)->orderBy('default', 'desc');
        if ($languages->exists()) {
            $reference_id = null;
            foreach ($languages->get() as $language) {
                $responseContent = Model::find($response->id)->contents()->create();

                $content = Model::find($response->id)
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

        return redirect()->route("{$this->Route}.form", ['id' => $response->id]);
    }

    public function update(int $id, ProductsUpdate $request)
    {
        Model::find($id)->fill($request->all())->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id]);
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
            'navLanguageRoute'       => "{$this->Route}.content",
            'navLanguageRouteParams' => ['id' => $id, 'category_id' => $request->category_id],
        ];

        $LanguageDefault = Languages::where('default', true)->first();

        $language_id             = isset($request->language_id) ? $request->language_id : $LanguageDefault->id;
        $data['language_id']     = $language_id;
        $data['languageDefault'] = $LanguageDefault;

        $CategoryContent = Model::find($id)->contents->where('language_id', $language_id)->first();
        $data['content'] = $CategoryContent;

        $Form = new FormElement;
        $Form->setAutocomplete(false);
        $Form->setMethod('post');
        $Form->setAction(route("{$this->Route}.content-update", ['id' => $id]));

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

        return view("{$this->Route}.content", $data);
    }

    public function contentUpdate(int $id, Request $request)
    {
        $Content = Model::find($id)->contents->where('language_id', $request->language_id)->first();

        $Content->fill($request->all())->save();

        return redirect()->route("{$this->Route}.content", ['id' => $id, 'language_id' => $request->language_id]);
    }

}
