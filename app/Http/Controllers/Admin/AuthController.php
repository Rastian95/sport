<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Session;

class AuthController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Auth/Login');
    }

    public function validar(LoginRequest $request)
    {
        $remember = $request->has("remember");
        $credentials = $request->only('usuario', 'password');
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect()->intended(route('admin::dash'));
        }
        return redirect()->back()->withErrors('Usuario o Contraseña incorrecta');
    }

    public function salir() {
        Session::flush();
        Auth::guard('admin')->logout();
        return redirect()->route('admin::login');
    }

}
