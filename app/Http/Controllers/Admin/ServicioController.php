<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicioController extends Controller
{

    public function search(Request $request)
    {
        $query = Servicio::query();
        if($request->input('search')) {
            $query->where('nombre', 'LIKE', '%'.mb_strtoupper($request->input('search')).'%');
        }
        $servicios = $query->limit(10)->get();
        return ['servicios' => $servicios];
    }
}
