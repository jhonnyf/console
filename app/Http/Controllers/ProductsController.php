<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsStore;
use App\Http\Requests\ProductsUpdate;
use App\Models\Products as Model;

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

        return redirect()->route("{$this->Route}.form", ['id' => $response->id]);
    }

    public function update(int $id, ProductsUpdate $request)
    {
        Model::find($id)->fill($request->all())->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id]);
    }

}
