<?php

use App\Http\Controllers\MangaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangaDexProxyController;
//manejo de persimos proxy
//Route::get('/manga/{id}/feed', [MangaDexProxyController::class, 'fetchFeed']);

Route::get('/get_cover', [MangaController::class, 'getCover'])->name('get.cover');