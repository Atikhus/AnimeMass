<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MangaDexProxyController extends Controller
{
    public function fetchFeed($id)
{
    $response = Http::get("https://api.mangadex.org/manga/{$id}/feed");
    
    if ($response->successful()) {
        return response()->json($response->json()); // Esto debería enviar la respuesta correcta al frontend
    }

    return response()->json(['error' => 'No se pudo obtener el feed del manga'], $response->status());
}

    
    

}
