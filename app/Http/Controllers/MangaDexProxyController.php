<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MangaDexProxyController extends Controller
{
    public function fetchFeed($id)
{
    // Cambia 'url_de_la_api_externa' a la URL real de la API de MangaDex
    $response = Http::get("url_de_la_api_externa/manga/{$id}/feed");

    // Asegúrate de manejar el caso en que la API externa no retorne lo esperado
    if ($response->successful()) {
        return response()->json($response->json());
    }

    // Manejo de errores en caso de que la API externa no responda correctamente
    return response()->json(['error' => 'No se pudo obtener el feed del manga'], $response->status());
}

}
