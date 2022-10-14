<?php

use App\Http\Controllers\Admin\{AuthController,
    DashController,
    OrdenController,
    PerfilController,
    ServicioController,
    UsuarioController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Control Routes
|--------------------------------------------------------------------------
|
| Here is where you can register control routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('admin::')->group(function () {

    Route::middleware(['guest:admin', 'prevent.back'])->group(function () {
        Route::get('login', [AuthController::class, 'index'])->name('login');
        Route::post('login', [AuthController::class, 'validar'])->name('login.validar');
    });

    Route::middleware(["auth:admin", 'prevent.back'])->group( function () {
        //DASHBOARD
        Route::get('/', [DashController::class, 'index'])->name('dash');
        Route::get('logout', [AuthController::class, 'salir'])->name('logout');

        //PERFIL
        Route::get('perfil', [PerfilController::class, 'show'])->name('perfil.ver');

        //
        Route::get('ordenes/crear', [OrdenController::class, 'crear'])->name('ordenes.crear');
        Route::post('ordenes/store', [OrdenController::class, 'store'])->name('ordenes.store');
        Route::get('ordenes/{orden}/show', [OrdenController::class, 'show'])->name('ordenes.show');

        Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::post('usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
        Route::get('usuarios/{usuario}/show', [UsuarioController::class, 'show'])->name('usuarios.show');
        Route::get('usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('usuarios/{usuario}/update', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::delete('usuarios/{usuario}/destroy', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

        Route::post('servicios/search', [ServicioController::class, 'search'])->name('servicios.search');

    });

});
