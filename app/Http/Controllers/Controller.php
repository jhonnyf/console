<?php

namespace App\Http\Controllers;

use App\Services\Metadata\Metadata;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $Model;
    protected $Route;

    public function __construct($Model = null)
    {
        if (is_null($Model) === false) {
            $this->Model = new $Model;
        }
    }

    public function form(int $id = null, Request $request)
    {
        $data = ['id' => $id, 'requestData' => $request->all()];

        $formValues = $this->Model->find($id);
        if ($formValues) {
            $formValues = $formValues->toArray();
        } else {
            $formValues = [];
        }

        $data['formFields'] = Metadata::formFields($this->Model->getTable(), $formValues);
        $data['route']      = $this->Route;

        return view("{$this->Route}.form", $data);
    }

    public function active(int $id)
    {
        $Object = $this->Model->find($id);

        $Object->active = $Object->active === 1 ? 0 : 1;
        $Object->save();

        return redirect()->back();
    }

    public function destroy(int $id)
    {
        $Object = $this->Model->find($id);

        $Object->active = 2;
        $Object->save();

        return redirect()->back();
    }
}
