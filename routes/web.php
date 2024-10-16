<?php

use App\Http\Controllers\KomgaController;
use App\Http\Controllers\ManejoEntradas;
use App\Http\Controllers\MangaController;
use Illuminate\Support\Facades\Route;

// Página de inicio
Route::get('/', function () {
    return view('index');
});

// Rutas para inicio de sesión
Route::get('/login', [ManejoEntradas::class, 'showLoginForm'])->name('login');
Route::post('/login', [ManejoEntradas::class, 'login'])->name('login.process');

// Rutas para registro de usuario
Route::get('/sign', [ManejoEntradas::class, 'showSignForm'])->name('sign');
Route::post('/sign', [ManejoEntradas::class, 'sign'])->name('sign.process');

// Ruta para el panel de control (después de iniciar sesión)
Route::get('/control_panel', [ManejoEntradas::class, 'showForm'])->name('control_panel')->middleware('auth');

// Ruta para mostrar la vista de sesión iniciada
Route::get('/sesion_iniciada', [ManejoEntradas::class, 'mostrarSesionIniciada'])->name('sesion_iniciada')->middleware('auth');

// Rutas para la búsqueda de mangas en la sesión iniciada
Route::post('/buscar_manga', [MangaController::class, 'buscarManga'])->name('buscar.manga');

// Ruta para obtener las series de Komga
Route::get('/komga-series', [KomgaController::class, 'getSeries'])->name('komga.series');

// Ruta para mostrar los detalles de un manga específico
Route::get('/manga/{id}', [MangaController::class, 'detallesManga'])->name('manga.detalle');

// Ruta para leer el contenido del manga o capítulo
Route::get('/capitulo/{id}/leer', [MangaController::class, 'leerContenido'])->name('capitulo.leer');

// Ruta exclusiva para leer el capítulo de un manga
Route::get('/manga/leer/{id}', [MangaController::class, 'leerCapitulo'])->name('manga.leer');
