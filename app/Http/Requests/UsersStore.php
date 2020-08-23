<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersStore extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_type_id' => 'required|integer|exists:users_types,id',
            'name'         => 'required|string|min:3',
            'email'        => 'required|string|unique:users',
            'password'     => 'nullable',
            'document'     => 'required|unique:users',
            'phone'        => 'nullable|min:8',
            'cellphone'    => 'nullable|min:8',
        ];
    }
}
