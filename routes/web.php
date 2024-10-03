<?php

use App\Http\Controllers\ManejoEntradas;
use App\Http\Controllers\CategoriaController; // Asegúrate de que sea App\Http\Controllers
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});



// Route::get('/',[CategoriaController::class,'index']);S


Route::get('/login', [ManejoEntradas::class, 'showLoginForm'])->name('login'); 
Route::post('/login', [ManejoEntradas::class, 'login'])->name('login.process');

Route::get('/sign', [ManejoEntradas::class, 'showSignForm'])->name('sign');
Route::post('/sign', [ManejoEntradas::class, 'sign'])->name('sign.process');



Route::get('/sesion_iniciada', [ManejoEntradas::class, 'showForm']);
Route::post('/sesion_iniciada', [ManejoEntradas::class, 'sesion_iniciada'])->name('sesion_iniciada');


// solicitudes al servidor
