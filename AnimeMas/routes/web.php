<?php


use App\Http\Controllers\ManejoEntradas;

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\CategoriaController;
use Illuminate\Routing\RouteParameterBinder;

/*
Route::get('/', function () {
    return view('welcome');
});
 */

//Route::get('/',[CategoriaController::class,'index']);

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [ManejoEntradas::class, 'showLoginForm'])->name('login'); 
Route::post('/login', [ManejoEntradas::class, 'login'])->name('login.process');

Route::get('/sign', [ManejoEntradas::class, 'showSignForm'])->name('sign'); 
Route::post('/sign', [ManejoEntradas::class, 'sign'])->name('sign.process');

