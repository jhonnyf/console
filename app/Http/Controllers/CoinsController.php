<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoinsStore;
use App\Http\Requests\CoinsUpdate;
use App\Models\Coins as Model;

class CoinsController extends Controller
{
    public function __construct()
    {
        $this->Route = 'coins';
        parent::__construct(Model::class);
    }

    public function store(CoinsStore $request)
    {
        $response = Model::create($request->all());

        return redirect()->route("{$this->Route}.form", ['id' => $response->id]);
    }

    public function update(int $id, CoinsUpdate $request)
    {
        Model::find($id)->fill($request->all())->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id]);
    }

}
