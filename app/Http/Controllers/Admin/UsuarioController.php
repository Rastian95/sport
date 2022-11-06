<?php

namespace App\Http\Controllers\Admin;

use App\Events\UsuarioEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsuarioPost;
use App\Http\Requests\UpdateUsuarioPut;
use App\Models\Usuario;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UsuarioController extends Controller
{

    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                $query->where('nombre', 'LIKE', "%{$value}%")->orWhere('correo', 'LIKE', "%{$value}%");
            });
        });

        $usuarios = QueryBuilder::for(Usuario::class)
            ->defaultSort('nombre')
            ->allowedSorts(['nombre', 'correo', 'usuario'])
            ->allowedFilters(['nombre', 'correo', 'usuario', $globalSearch])
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Usuarios/Index', [
            'usuarios' => $usuarios,
        ])->table(function (InertiaTable $table) {
            $table->addSearchRows([
                'nombre' => 'Nombre',
                'correo' => 'Correo',
                'usuario' => 'Usuario',
            ]);
        });
    }

    public function create()
    {
        return Inertia::render('Admin/Usuarios/Crear');
    }

    public function store(StoreUsuarioPost $request)
    {
        $usuario = Usuario::create($request->all());
        event(new UsuarioEvent($usuario));
        return Redirect::route('admin::usuarios.store')->with('message', 'El usuario ha sido creado');
    }

    public function show(Usuario $usuario)
    {
        return Inertia::render('Admin/Usuarios/Ver', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        return Inertia::render('Admin/Usuarios/Editar', compact('usuario'));
    }

    public function update(UpdateUsuarioPut $request, Usuario $usuario)
    {
        $usuario->update($request->all());
        return redirect()->back()->with('message', 'El usuario ha sido editado');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->back()->with('message', 'El usuario ha sido eliminado');
    }
}
