<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MangaController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    // Método para buscar manga usando el título proporcionado por el usuario
    public function buscarManga(Request $request)
    {
        $titulo = $request->input('titulo');

        try {
            // Realizamos la solicitud a la API de MangaDex con el título
            $response = $this->client->request('GET', "https://api.mangadex.org/manga?title=" . urlencode($titulo));
            $mangas = json_decode($response->getBody()->getContents());

            // Retornamos la vista con los datos de los mangas encontrados
            return view('sesion_iniciada', compact('mangas'));
        } catch (\Exception $e) {
            // En caso de error, regresamos a la página anterior con un mensaje de error
            return back()->withErrors(['error' => 'Error al buscar manga: ' . $e->getMessage()]);
        }
    }
}
