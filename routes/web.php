<?php

use App\Http\Controllers\KomgaController;
use App\Http\Controllers\ManejoEntradas;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\MangaDexProxyController;
// Página de inicio
Route::get('/', function () {
    return view('index');
});

// Rutas para inicio de sesión
Route::get('/login', [ManejoEntradas::class, 'showLoginForm'])->name('login');
Route::post('/login', [ManejoEntradas::class, 'login'])->name('login.process');

// Rutas para registro
Route::get('/sign', [ManejoEntradas::class, 'showSignForm'])->name('sign');
Route::post('/sign', [ManejoEntradas::class, 'sign'])->name('sign.process');

// Ruta para el panel de control
Route::get('/control_panel', [ManejoEntradas::class, 'showForm'])->name('control_panel');

// Rutas para la API Komga
Route::get('/komga-series', [KomgaController::class, 'getSeries']);

// Ruta para mostrar la vista de sesión iniciada y manejar la búsqueda de mangas
//Route::get('/sesion_iniciada', [MangaController::class, 'buscarManga'])->name('sesion_iniciada')->middleware('auth');

// Ruta para procesar la búsqueda de manga
//Route::post('/buscar-manga', [MangaController::class, 'buscarManga'])->name('buscar.manga');
// Ruta para mostrar la vista de sesión iniciada
Route::get('/sesion_iniciada', [ManejoEntradas::class, 'mostrarSesionIniciada'])->name('sesion_iniciada')->middleware('auth');
Route::post('/sesion_iniciada', [MangaController::class, 'buscarManga'])->name('buscar.manga');

// Ruta para mostrar detalles del manga
Route::get('/manga/{id}', [MangaController::class, 'detallesManga'])->name('manga.detalles');

//manejo de persimos proxy
Route::get('/manga/{id}/feed', [MangaDexProxyController::class, 'fetchFeed']);