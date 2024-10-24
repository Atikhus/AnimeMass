<?php

use App\Http\Controllers\MangaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangaDexProxyController;
use App\Http\Controllers\ProgressController;
//manejo de persimos proxy
//Route::get('/manga/{id}/feed', [MangaDexProxyController::class, 'fetchFeed']);

Route::get('/get_cover', [MangaController::class, 'getCover'])->name('get.cover');

// routes/api.php guardar el progreso del usuario en la db
Route::post('/save-progress', [ProgressController::class, 'saveProgress']);

Route::middleware('auth:sanctum')->post('/save-progress', [ProgressController::class, 'saveProgress']);




