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
        $mangas = $this->enviarManga();
        //dd($mangas);

        return view('vista_content', compact('mangas'));
    }

    //este metodo enviara contenido por default al fronend
    public function enviarManga()
    {
        try {
            // Usamos el servicio para obtener los mangas default
            $mangas = $this->mangaReaderService->getAllMangas();

            // Retornamos los datos de los mangas
            return $mangas;
        } catch (\Exception $e) {
            // Si hay un error, retornamos un array vacío y guardamos el error en la sesión
            session()->flash('error', 'Error al obtener los detalles del manga: ' . $e->getMessage());
            return [];
        }
    }
    //funcion unica de vista_content para enviar cover al front
    public function mostrarMangas()
    {
        $mangasConCover = $this->mangaReaderService->getAllMangas();
        return view('vista_content', ['mangas' => $mangasConCover]);
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

    //aqui vamos a crear un metodo UNICAMENTE para la vista vista_content no usar para otras
    public function obtenerCoverPorId($mangas)
    {
        try {
            $mangasConCover = [];

            // Iterar sobre cada manga en la respuesta
            foreach ($mangas->data as $manga) {
                $id = $manga->id;

                // Buscar el cover_art en las relaciones
                $coverArt = collect($manga->relationships)->where('type', 'cover_art')->first();

                // Si encontramos un cover, construimos la URL
                $coverUrl = $coverArt ? "https://uploads.mangadex.org/covers/{$id}/{$coverArt->attributes->fileName}" : null;

                // Agregar el manga y su portada a la colección
                $mangasConCover[] = [
                    'id' => $id,
                    'title' => $manga->attributes->title->en ?? 'Título no disponible',
                    'cover_url' => $coverUrl
                ];
            }

            // Retornar la colección de mangas con sus portadas
            return response()->json(['success' => true, 'mangas' => $mangasConCover]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener el cover del manga: ' . $e->getMessage()
            ]);
        }
    }



    //sin uso ahun
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
        //dd($userLinks);

        return response()->json($userLinks); // Retorna los links como JSON

    }
    //eliminar de la lista de favo
    public function eliminarManga($id)
    {
        $userId = Auth::id();
        $manga = UserLink::where('id', $id)->where('user_id', $userId)->first();

        if ($manga) {
            $manga->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
