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

    // Método para mostrar la vista de sesión iniciada sin resultados
    public function mostrarSesionIniciada()
    {
        $mangas = null; // O puedes usar []
        return view('sesion_iniciada', compact('mangas'));
        //return view('sesion_iniciada'); // Sin pasar mangas
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

    // Método para obtener los detalles de un manga específico
    public function detallesManga($id)
{
    try {
        $response = $this->client->request('GET', "https://api.mangadex.org/manga/{$id}");
        $manga = json_decode($response->getBody()->getContents());

        // Verificar si los detalles del manga están disponibles
        if (empty($manga) || !isset($manga->data->relationships)) {
            return back()->withErrors(['error' => 'Detalles del manga no disponibles.']);
        }

        return view('detalles', ['manga' => $manga->data]); // Pasa solo el objeto data
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Error al obtener detalles del manga: ' . $e->getMessage()]);
    }
}

    
    

    

    
    
}
