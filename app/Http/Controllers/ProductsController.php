<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsStore;
use App\Http\Requests\ProductsUpdate;
use App\Models\Coins;
use App\Models\Languages;
use App\Models\Products as Model;
use App\Services\FormElement\FormElement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $coins = Coins::where('active', '<>', 2)->orderBy('default', 'desc');
        if ($coins->exists()) {
            foreach ($coins->get() as $coin) {
                $responsePrice = Model::find($response->id)->prices()->create();

                $Price = Model::find($response->id)
                    ->prices()
                    ->where('id', $responsePrice->id)
                    ->first();

                $Price->coin_id = $coin->id;

                $Price->save();
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
            'navLanguageRoute'       => "{$this->Route}.content",
            'navLanguageRouteParams' => ['id' => $id],
        ];

        $LanguageDefault = Languages::where('default', true)->first();

        $language_id             = isset($request->language_id) ? $request->language_id : $LanguageDefault->id;
        $data['language_id']     = $language_id;
        $data['languageDefault'] = $LanguageDefault;

        $Content         = Model::find($id)->contents->where('language_id', $language_id)->first();
        $data['content'] = $Content;

        $Form = new FormElement;
        $Form->setAutocomplete(false);
        $Form->setMethod('post');
        $Form->setAction(route("{$this->Route}.content-update", ['id' => $id]));

        $language_id = $Form->newElement('input');
        $language_id->setName('language_id');
        $language_id->setType('hidden');
        $language_id->setValue($Content->language_id);

        $Form->addElement($language_id);

        $title = $Form->newElement('input');
        $title->setName('title');
        $title->setValue($Content->title);

        $Form->addElement($title);

        $content = $Form->newElement('textarea');
        $content->setName('content');
        $content->setValue($Content->content);

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

    /**
     * PRICE
     */

    public function price(int $id, Request $request)
    {
        $data = [
            'id'                 => $id,
            'route'              => $this->Route,
            'name'               => $this->Name,
            'nav'                => $this->setNav($request, $id),
            'navCoinRoute'       => "{$this->Route}.price",
            'navCoinRouteParams' => ['id' => $id],
        ];

        $CoinDefault = Coins::where('default', true)->first();

        $coin_id             = isset($request->coin_id) ? $request->coin_id : $CoinDefault->id;
        $data['coin_id']     = $coin_id;
        $data['coinDefault'] = $CoinDefault;

        $Price = Model::find($id)->prices->where('coin_id', $coin_id)->first();

        $Form = new FormElement;
        $Form->setAutocomplete(false);
        $Form->setMethod('post');
        $Form->setAction(route("{$this->Route}.price-update", ['id' => $id]));

        $coin_id = $Form->newElement('input');
        $coin_id->setName('coin_id');
        $coin_id->setType('hidden');
        $coin_id->setValue($Price->coin_id);

        $Form->addElement($coin_id);

        $cost_price = $Form->newElement('input');
        $cost_price->setName('cost_price');
        $cost_price->setValue($Price->cost_price);

        $Form->addElement($cost_price);

        $price = $Form->newElement('input');
        $price->setName('price');
        $price->setType('number');
        $price->setValue($Price->price);

        $Form->addElement($price);

        $final_price = $Form->newElement('input');
        $final_price->setLabel('Final Price');
        $final_price->setType('number');
        $final_price->setReadOnly(true);
        $final_price->setValue($Price->final_price);

        $Form->addElement($final_price);

        $data['form'] = $Form->render($data);

        return view("{$this->Route}.price", $data);
    }

    public function priceUpdate(int $id, Request $request)
    {
        $Price = Model::find($id)->prices->where('coin_id', $request->coin_id)->first();

        $Price->fill($request->all());

        $Price->final_price = $request->price;

        $Price->save();

        return redirect()->route("{$this->Route}.price", ['id' => $id, 'coin_id' => $request->coin_id]);
    }

    /**
     * COMBO CODE
     */

    public function comboCode(int $id, Request $request)
    {
        $data = [
            'id'    => $id,
            'route' => $this->Route,
            'name'  => $this->Name,
            'nav'   => $this->setNav($request, $id),
        ];

        $Product = Model::find($id);

        $data['Product'] = $Product;

        $code = empty($Product->combo_code) ? Str::random(8) : $Product->combo_code;

        $Form = new FormElement;
        $Form->setAutocomplete(false);
        $Form->setMethod('post');
        $Form->setAction(route("{$this->Route}.combo-code-save", ['id' => $id]));

        $combo_code = $Form->newElement('input');
        $combo_code->setType('text');
        $combo_code->setName('combo_code');
        $combo_code->setLabel('Código');
        $combo_code->setValue($code);

        $Form->addElement($combo_code);

        $data['form'] = $Form->render($data);

        if (empty($Product->combo_code) === false) {
            $data['productsCombo'] = Model::where('combo_code', $Product->combo_code)->get();
        }        

        return view('products.combo-code', $data);
    }

    public function comboCodeSave(int $id, Request $request)
    {
        $Produto = Model::find($id);

        $Produto->combo_code = $request->combo_code;

        $Produto->save();

        return redirect()->route("{$this->Route}.combo-code", ['id' => $id]);
    }

    public function comboCodeDestroy(int $id, Request $request)
    {
        $Product = Model::find($id);

        $Product->combo_code = null;
        $Product->save();

        return redirect()->route("{$this->Route}.combo-code", ['id' => $request->product]);
    }

    /**
     * SEARCH PRODUCT
     */

    public function searchProduct(Request $request)
    {
        $data = [
            'route'    => $this->Route,
            'btn_back' => false,
        ];

        $Form = new FormElement;
        $Form->setAutocomplete(false);
        $Form->setMethod('post');
        $Form->setAction(route("{$this->Route}.search"));
        $Form->setClass(['form-ajax']);

        $comboCode = $Form->newElement('input');
        $comboCode->setType('hidden');
        $comboCode->setName('combo_code');
        $comboCode->setValue($request->combo_code);

        $Form->addElement($comboCode);

        $search = $Form->newElement('input');
        $search->setName('search');
        $search->setLabel("Busca");
        $search->setType('text');

        $Form->addElement($search);

        $data['form'] = $Form->render($data);

        $response = [
            'error'   => false,
            'message' => 'sucesso',
            'result'  => view('products.search-product', $data)->render(),
        ];

        return response()->json($response);
    }

    public function search(Request $request)
    {
        $result = Model::where('sku', $request->search)
            ->get();

        $response = [
            'error'   => false,
            'message' => 'Sucesso',
            'result'  => [
                'html' => view('products.ajax.search', ['products' => $result, 'combo_code' => $request->combo_code])->render(),
            ],
        ];

        return response()->json($response);
    }

    public function addComboSave(int $id, string $comboCode)
    {
        $Product = Model::find($id);
        if ($Product->exists()) {
            $Product->combo_code = $comboCode;

            $Product->save();
        }

        return ['error' => false, 'message' => 'Ação realizada com sucesso!', 'result' => []];
    }
}
