<?php

namespace App\Http\Controllers\Admin;

use App\Events\UsuarioEvent;
use App\Http\Controllers\Controller;

use App\Models\Usuario;
use Inertia\Inertia;

class DashController extends Controller
{

    public function index()
    {
        return Inertia::render('Admin/Dashboard');
    }

    public function prueba()
    {
        $usuario = Usuario::where('id', 1)->first();
        event(new UsuarioEvent($usuario));
        return "Event has been sent!";
    }

}
