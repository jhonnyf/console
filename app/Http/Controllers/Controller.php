<?php

namespace App\Http\Controllers;

use App\Services\Metadata\Metadata;
use App\Services\QueryService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $Model;
    protected $Route;
    protected $TableName;
    protected $Name;

    public function __construct($Model = null)
    {
        if (is_null($Model) === false) {
            $this->Model = new $Model;
            $this->setModuleVariables();
        }
    }

    public function index(Request $request)
    {
        $data = [
            'search' => isset($request->search) ? $request->search : '',
            'route'  => $this->Route,
            'name'   => $this->Name,
        ];

        $setData = $this->setData($request);
        if (count($setData) > 0) {
            $data['extraData'] = $setData;
            $data              = array_merge($data, $setData);
        }

        $list = $this->Model->query();

        $setCondition = $this->setCondition($request);
        if (count($setCondition) > 0) {
            foreach ($setCondition as $field => $value) {
                if (is_array($value)) {
                    $list->whereIn($field, $value);
                } else {
                    $list->where($field, $value);
                }
            }
        }

        if (isset($request->search)) {
            $fields = QueryService::fieldsLike($this->TableName);
            $list->where(function ($q) use ($fields, $request) {
                foreach ($fields as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search}%");
                }
            });
        }

        $data['tableFields'] = Metadata::tableFields($this->Model->getTable());
        $data['tableValues'] = $list->where('active', '<>', 2)
            ->orderBy('id', 'desc')
            ->get();

        return view("{$this->Route}.index", $data);
    }

    public function form(int $id = null, Request $request)
    {
        $data = [
            'id'    => $id,
            'route' => $this->Route,
            'name'  => $this->Name,
            'nav'   => $this->setNav($request, $id),
        ];

        $setData = $this->setData($request);
        if (count($setData) > 0) {
            $data['extraData'] = $setData;
            $data              = array_merge($data, $setData);
        }

        $formValues = $this->Model->find($id);
        $formValues = $formValues ? $formValues->toArray() : [];

        $data['formFields'] = Metadata::formFields($this->Model->getTable(), $formValues);

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

    /**
     * EXTRA
     */

    private function setModuleVariables(): void
    {
        $ModuleConfig = App::make("App\Services\ModuleConfig\Module\\" . ucwords($this->Route) . "ModuleConfig");

        $this->Route     = $ModuleConfig->Route;
        $this->TableName = $ModuleConfig->TableName;
        $this->Name      = $ModuleConfig->Name;
    }

    protected function setData(Request $request): array
    {
        $ModuleConfig = App::make("App\Services\ModuleConfig\Module\\" . ucwords($this->Route) . "ModuleConfig");

        return $ModuleConfig->setData($request);
    }

    protected function setCondition(Request $request): array
    {
        $ModuleConfig = App::make("App\Services\ModuleConfig\Module\\" . ucwords($this->Route) . "ModuleConfig");

        return $ModuleConfig->setCondition($request);
    }

    protected function setNav(Request $request, int $id = null): array
    {
        $ModuleConfig = App::make("App\Services\ModuleConfig\Module\\" . ucwords($this->Route) . "ModuleConfig");

        return $ModuleConfig->setNav($request, $id);
    }
}
