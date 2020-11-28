<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersStore;
use App\Http\Requests\UsersUpdate;
use App\Models\Categories;
use App\Models\CategoriesUsers;
use App\Models\Users;
use App\Models\Users as Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct(Model::class);

        $this->Route     = 'users';
        $this->TableName = 'users';
        $this->Name      = 'Usuário';
    }

    public function store(UsersStore $request)
    {
        $create = $request->all();

        if (empty($create['password']) === false) {
            $create['password'] = Hash::make($create['password']);
        } else {
            unset($create['password']);
        }

        $response = Model::create($create);
        if (isset($create['category_id'])) {
            $this->saveLink($create['category_id'], $response->id);
        }

        return redirect()->route("{$this->Route}.form", ['id' => $response->id, 'category_id' => $request->category_id]);
    }

    public function update(int $id, UsersUpdate $request)
    {
        $fill = $request->all();

        if (empty($fill['password']) === false) {
            $fill['password'] = Hash::make($fill['password']);
        } else {
            unset($fill['password']);
        }

        Model::find($id)->fill($fill)->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id, 'category_id' => $request->category_id]);
    }

    /**
     * EXTRA
     */

    protected function setData(Request $request): array
    {
        return ['category_id' => $request->category_id];
    }

    protected function setCondition(Request $request): array
    {
        $links = CategoriesUsers::where('category_id', $request->category_id)
            ->get()
            ->keyBy('user_id')
            ->toArray();

        return ['id' => array_keys($links)];
    }

    protected function setNav(Request $request, int $id = null): array
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
        }

        return $response;
    }

    private function saveLink(int $category_id, int $user_id): bool
    {
        $response = false;
        CategoriesUsers::where('user_id', $user_id)->delete();

        $insert = ['category_id' => $category_id, 'user_id' => $user_id];
        if (CategoriesUsers::where($insert)->exists() === false) {
            CategoriesUsers::create($insert);
            $response = true;
        }

        return $response;
    }

    public function category(int $id, Request $request)
    {
        $data = [
            'id'         => $id,
            'route'      => $this->Route,
            'name'       => $this->Name,
            'nav'        => $this->setNav($request, $id),
            'categories' => Categories::find(2),
        ];

        $data['category'] = Users::find($id)->category->first();

        return view('users.category', $data);
    }

    public function categoryStore(int $id, Request $request)
    {
        $this->saveLink($request->category_id, $id);

        return redirect(route('users.category', ['id' => $id]));
    }

    public function password(int $id, Request $request)
    {
        $data = [
            'id'    => $id,
            'route' => $this->Route,
            'nav'   => $this->setNav($request, $id),
        ];

        return view('users.password', $data);
    }

}
