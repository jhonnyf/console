<?php

namespace App\Http\Controllers;

use App\Http\Requests\Password;
use App\Http\Requests\UsersStore;
use App\Http\Requests\UsersUpdate;
use App\Models\Categories;
use App\Models\CategoriesUsers;
use App\Models\Users as Model;
use App\Services\FormElement\FormElement;
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

        $form = new FormElement;

        $form->setAction(route('users.category-store', ['id' => $id]));
        $form->setAutocomplete('off');
        $form->setMethod('post');

        $categoryId = $form->newElement('select');
        $categoryId->setName('category_id');
        $categoryId->setLabel('Categoria');

        $categories = Categories::find(2)->categorySecondary;
        if ($categories->count() > 0) {
            $options = [];
            foreach ($categories as $key => $value) {
                $options[$value->id] = $value->category;
            }

            $categoryId->setOptions($options);
            $categoryId->setValue(Model::find($id)->category->first()->id);
        }

        $form->addElement($categoryId); 

        $data['form'] = $form->render($data);

        return view('users.category', $data);
    }

    public function categoryStore(int $id, Request $request)
    {
        $this->saveLink($request->category_id, $id);

        return redirect()->route('users.category', ['id' => $id]);
    }

    public function password(int $id, Request $request)
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

        $form = new FormElement;

        $form->setAction(route('users.password-store', ['id' => $id]));
        $form->setAutocomplete('off');
        $form->setMethod('post');

        $password = $form->newElement('input');
        $password->setName('password');
        $password->setType('password');
        $password->setLabel('Senha');

        $form->addElement($password);

        $coPassword = $form->newElement('input');
        $coPassword->setName('co-password');
        $coPassword->setType('password');
        $coPassword->setLabel('Confirmação de senha');

        $form->addElement($coPassword);

        $data['form'] = $form->render($data);

        return view('users.password', $data);
    }

    public function passwordStore(int $id, Password $request)
    {
        Model::find($id)->fill(['password' => Hash::make($request->password)])->save();

        return redirect()->route("{$this->Route}.password", ['id' => $id, 'category_id' => $request->category_id]);
    }

}
