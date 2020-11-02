<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index(Request $request)
    {
        return view('login.index');
    }

    public function authenticate(Login $request)
    {
        if (Auth::attempt($request->only(['email', 'password'])) === false) {
            return redirect()->route('login.index');
        }

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login.index');
    }
}
