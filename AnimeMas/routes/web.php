<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\CategoriaController;
use Illuminate\Routing\RouteParameterBinder;
/*
Route::get('/', function () {
    return view('welcome');
});
 */

Route::get('/',[CategoriaController::class,'index']);

Route::get('/', function () {
    return view('index');
});

