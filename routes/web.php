<?php

use App\Http\Controllers\KomgaController;
use App\Http\Controllers\ManejoEntradas;
use App\Http\Controllers\MangaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
//borrar
use App\Http\Controllers\ProgressController;

// Página de inicio
Route::get('/', function () {
    return view('index');
});

//solo para mostrar el index despues de que inicio sesion
Route::get('/index', [ManejoEntradas::class, 'showIndex'])->name('index');
// Rutas para inicio de sesión
Route::get('/login-me', [ManejoEntradas::class, 'showLoginForm'])->name('login-me');
Route::post('/login-me', [ManejoEntradas::class, 'login'])->name('login.process');

//cerrar sesion desde el dashboar perfil

Route::get('/logout', [ManejoEntradas::class, 'logout'])->name('logout');




//rutas de permisos
Route::middleware('login-me')->group(function(){
    Route::get('/mangaka_mode',function(){
        return view('mangaka.mangaka_panel');
    });

});

// Rutas para registro de usuario
Route::get('/sign', [ManejoEntradas::class, 'showSignForm'])->name('sign');
Route::post('/sign', [ManejoEntradas::class, 'sign'])->name('sign.process');

// Ruta para el panel de control (después de iniciar sesión)
Route::get('/control_panel', [ManejoEntradas::class, 'showForm'])->name('control_panel')->middleware('auth');

// Ruta para mostrar la vista de sesión iniciada
Route::get('/sesion_iniciada', [ManejoEntradas::class, 'mostrarSesionIniciada'])->name('sesion_iniciada')->middleware('auth');
//ruta para mostrar sesion iniciada con contenido por default
// Ruta para mostrar la vista de sesión iniciada
Route::get('/sesion.iniciada', [MangaController::class, 'mostrarSesionIniciada'])->name('sesion.iniciada')->middleware('auth');

//ruta pora mostrar las categorias de manga
Route::middleware(['auth'])->group(function () {
Route::get('/categories/filter',[ManejoEntradas::class,'showCategories'])->name('categories');

});

Route::middleware(['auth'])->group(function () {
// Rutas para la búsqueda de mangas en la sesión iniciada
Route::post('/buscar_manga', [MangaController::class, 'buscarManga'])->name('buscar.manga');
});
// Ruta para obtener las series de Komga
Route::get('/komga-series', [KomgaController::class, 'getSeries'])->name('komga.series');

// Ruta para mostrar los detalles de un manga específico
Route::get('/manga/{id}', [MangaController::class, 'detallesManga'])->name('manga.detalle');

// Ruta para leer el contenido del manga o capítulo
Route::get('/capitulo/{id}/leer', [MangaController::class, 'leerContenido'])->name('capitulo.leer');

// Ruta exclusiva para leer el capítulo de un manga
Route::get('/manga/leer/{id}', [MangaController::class, 'leerCapitulo'])->name('manga.leer');


//rutas para los comentarios

Route::get('/comments/{mangaId}', [CommentController::class, 'index'])->middleware('login-me');
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');

//mostrar la vista del usuario con sus atributos
Route::get('/usuario', [ManejoEntradas::class, 'showProfile'])->name('usuario');
//ruta para mostrar la vista de lista manga favorito
Route::get('/lista_favoritos', [ManejoEntradas::class, 'showFavoriteList'])->name('lista_favoritos');

//ruta para enviar id a la base de datos
Route::post('/save-manga', [MangaController::class, 'saveMangaId']);
//traer esos id
Route::get('/lista-favoritos', [MangaController::class, 'listaFavoritos'])->middleware('auth')->name('lista.favoritos');

Route::delete('/eliminar-manga/{id}', [MangaController::class, 'eliminarManga']);

//ruta para mandar los cover de los mangas UNICAMENTE A LA VISTA vista_content
Route::get('/api/obtenerCoverPorId/{id}', [MangaController::class, 'obtenerCoverPorId']);
// En routes/web.php
Route::get('/vista_content', [MangaController::class, 'mostrarMangas'])->name('manga.covers');

use App\Http\Controllers\ProfileController;


//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';