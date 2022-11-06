<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrdenPost;
use App\Models\Cliente;
use App\Models\Faena;
use App\Models\Orden;
use App\Models\Usuario;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OrdenController extends Controller
{

    public function crear()
    {
        $clientes = Cliente::activo()->get();
        $vehiculos = Vehiculo::activo()->get();
        $faenas = Faena::all();
        return Inertia::render('Admin/Orden/Crear', compact('clientes', 'vehiculos', 'faenas'));
    }

    public function store(StoreOrdenPost $request)
    {
        $orden = Orden::create($request->all());
        $orden->servicios()->createMany($request->servicios);

        //event(new OrdenEvent($orden));
        //return Redirect::route('admin::ordenes.crear')->with('message', 'La orden ha sido creada')->with('orden', $orden);
        return ['message' => 'La orden ha sido creada', 'orden' => $orden];
    }

    public function show(Orden $orden)
    {
        $orden->load('cliente', 'usuario', 'vehiculo', 'faena', 'servicios.servicio', 'servicios.mecanico');
        return Inertia::render('Admin/Orden/Ver', compact('orden'));
    }
}
