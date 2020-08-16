<?php

namespace App\Http\Controllers;

use App\Models\UsersTypes as Model;
use App\Services\DbMetadataService;
use App\Services\TableListService;
use Illuminate\Support\Facades\DB;

class UsersTypesController extends Controller
{
    private $Model;

    public function __construct()
    {
        $this->Model = new Model;
    }

    public function index()
    {
        $data = [];

        $data['list'] = Model::where('active', '<>', 2)
            ->orderBy('id', 'desc')
            ->get();

        $data['tableColumns'] = TableListService::getTableFields($this->Model->getTable());

        return view('usersTypes.index', $data);
    }

    public function form()
    {
        $data = [];

        $data['tableMetaData'] = $this->getTableMetadata();

        return view('usersTypes.form', $data);
    }

    private function getTableMetadata()
    {
        $fields = DB::select('DESCRIBE ' . $this->Model->getTable());

        return DbMetadataService::fields($fields);
    }
}
