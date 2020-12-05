<?php

namespace App\Services\ModuleConfig\Module;

use App\Models\CategoriesUsers;
use App\Services\ModuleConfig\AbstractModuleConfig;
use Illuminate\Http\Request;

class UsersModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'users';
    public $TableName = 'users';
    public $Name      = 'Usuário';

    public function setData(Request $request): array
    {
        return ['category_id' => $request->category_id];
    }

    public function setCondition(Request $request): array
    {
        $links = CategoriesUsers::where('category_id', $request->category_id)
            ->get()
            ->keyBy('user_id')
            ->toArray();

        return ['id' => array_keys($links)];
    }

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('users.form', ['id' => $id, 'category_id' => $request->category_id]),
        ];

        if (is_null($id) === false) {

            $response[] = [
                'name'  => 'Categorias',
                'route' => route('users.category', ['id' => $id, 'category_id' => $request->category_id]),
            ];

            $response[] = [
                'name'  => 'Senha',
                'route' => route('users.password', ['id' => $id, 'category_id' => $request->category_id]),
            ];

            $response[] = [
                'name'  => 'Arquivos',
                'route' => route('files.listGalleries', ['module' => 'users', 'link_id' => $id, 'category_id' => $request->category_id]),
            ];

        }

        return $response;
    }
}
