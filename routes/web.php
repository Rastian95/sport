<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\TelegramController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('events', [EventController::class, 'index'])->name('events');
Route::get('events/data', [EventController::class, 'data'])->name('events.data');
Route::post('events', [EventController::class, 'store'])->name('events.store');

Route::get('telegram/test', [TelegramController::class, 'test'])->name('telegram.test');
Route::get('telegram/webhook', [TelegramController::class, 'webhook'])->name('telegram.webhook');

require __DIR__.'/auth.php';
