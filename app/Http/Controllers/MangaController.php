<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MangaReaderService;

class MangaController extends Controller
{
    private $mangaReaderService;

    public function __construct(MangaReaderService $mangaReaderService)
    {
        $this->mangaReaderService = $mangaReaderService;
    }

    // Método para mostrar la vista de sesión iniciada sin resultados
    public function mostrarSesionIniciada()
    {
        $mangas = null; // O puedes usar []
        return view('sesion_iniciada', compact('mangas'));
    }

    // Método para buscar manga usando el título proporcionado por el usuario
    public function buscarManga(Request $request)
{
    $titulo = $request->input('titulo');

    try {
        // Realizamos la solicitud a la API de Jikan con el título ingresado
        $mangas = $this->mangaReaderService->buscarMangaPorTitulo($titulo);

        
        //dd($mangas);

        return view('sesion_iniciada', compact('mangas'));
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Error al buscar manga: ' . $e->getMessage()]);
    }
}

    public function getCover(Request $request)
{
    $fileurl = $request->input('fileurl');

    try {
        $base64 = $this->mangaReaderService->getCoverBase64($fileurl);
        
        //dd($mangas);

        return response()->json([
            'base64' => $base64
        ]);
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Error al buscar manga: ' . $e->getMessage()]);
    }
}

    

   // Método para obtener los detalles de un manga específico
    public function detallesManga($id)
    {
        try {
           // Usamos el servicio para obtener los detalles del manga por su ID
            $mangaDetalle = $this->mangaReaderService->obtenerDetallesMangaPorId($id);
            //dd($mangaDetalle);
            // Verifica la estructura de datos
            //dd($mangaDetalle); // Para ver todos los detalles

           // Retornamos la vista con los detalles del manga
        return view('detalles', [
            'manga' => $mangaDetalle->data,
        ]);
        } catch (\Exception $e) {
           // En caso de error, volvemos a la página anterior con un mensaje de error
        return back()->withErrors(['error' => 'Error al obtener los detalles del manga: ' . $e->getMessage()]);
        }
}

    
    

public function leerCapitulo($id)
{
    $mangaService = new MangaReaderService();
    $imageUrls = $mangaService->obtenerCapituloPorId($id);
    //dd($mangaService);

return view('leer_capitulo', ['imageUrls' => $imageUrls]);
}




}
