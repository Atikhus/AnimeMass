<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MangaReaderService;
use App\Models\Manga;
use App\Models\UserLink;
use Illuminate\Support\Facades\Auth;

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
            
             // Almacenar los detalles en la sesión
            session(['manga' => $mangaDetalle->data]);
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


//guarda los id de los mangas en la base de datos
public function saveMangaId(Request $request)
{
    //dd($request->all());
    $request->validate([
        'url' => 'required|string',
        'manga_title' => 'required|string',
    ]);
    $userId = Auth::id();
    
    
    // Verifica si el usuario está autenticado
    if (!$userId) {
        return response()->json(['success' => false, 'message' => 'Usuario no autenticado'], 401);
    }
    

    // Guarda el ID en la base de datos
    UserLink::create([
        'user_id' => $userId,
        'url' => $request->url,
        'title' => $request->manga_title,
    ]);

    return response()->json(['success' => true]);
}
//trae los id de la base de datos a la vista favoritos

public function listaFavoritos()
{
    $userId = Auth::id(); // Obtener el ID del usuario autenticado
    $userLinks = UserLink::where('user_id', $userId)->get();
    
    return response()->json($userLinks); // Retorna los links como JSON
    
}





}
