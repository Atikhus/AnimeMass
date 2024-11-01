<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MangaReaderService
{
    private $client;
    private $baseUrl = 'https://api.mangadex.org'; 

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getMangas()
    {
        // Realizar la solicitud para obtener mangas 
        $response = $this->client->get("{$this->baseUrl}/"); 

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody()->getContents()); // Retorna los datos de los mangas
        }
        
        return null; // Retorna null si la solicitud falla
    }

    //trae una cantidad de 10 mangas por default
    public function getAllMangas()
{
    $response = $this->client->get("{$this->baseUrl}/manga", [
        'query' => [
            'limit' => 10,
            'order[createdAt]' => 'desc'
        ]
    ]);
    //dd($response);


    $mangasData = json_decode($response->getBody()->getContents(), true);

    // Recorre cada manga y agrega la URL del cover
    foreach ($mangasData['data'] as &$manga) {
        $coverData = $this->obtenerCoverPorId($manga['id']);
        $manga['cover_url'] = $coverData['cover_url'];
    }

    return $mangasData['data']; // Retorna un array simple de datos
}



     //aqui vamos a crear un metodo UNICAMENTE para la vista vista_content no usar para otras
    public function obtenerCoverPorId($id)
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/manga/{$id}", [
                'query' => ['includes[]' => 'cover_art']
            ]);

            $mangaData = json_decode($response->getBody()->getContents(), true);
            
             // Busca el cover art en los datos de relaciones
            $coverArt = collect($mangaData['data']['relationships'])->firstWhere('type', 'cover_art');
            if ($coverArt) {
                return [
                    'cover_url' => "https://mangadex.org/covers/{$id}/{$coverArt['attributes']['fileName']}"
                ];
            }
        } catch (\Exception $e) {
             // Maneja el error y retorna un arreglo con 'cover_url' como null
            return [
                'cover_url' => null,
                'error' => 'Error al obtener el cover del manga: ' . $e->getMessage()
            ];
        }
        
        return ['cover_url' => null];
    }
    


    public function buscarMangaPorTitulo($titulo)
{
    try {
        $response = $this->client->get("{$this->baseUrl}/manga", [
            'query' => [
                'title' => $titulo,
                'includes[]' => 'cover_art'
            ],
        ]);

        // Si obtenemos un código 200 (éxito)
        if ($response->getStatusCode() === 200) {
            $body = $response->getBody()->getContents();
            //dd($body);  // Muestra el contenido completo de la respuesta
            return json_decode($body)->data;  // Asegúrate de que la respuesta tenga la clave 'data'
        }

        return null;
    } catch (\Exception $e) {
        dd($e->getMessage());  // Captura cualquier error que ocurra durante la solicitud
    }
}

public function getCoverBase64($fileurl)
{
    try {
        $response = $this->client->get($fileurl);
        
        // Si obtenemos un código 200 (éxito)
        if ($response->getStatusCode() === 200) {
            $body = $response->getBody()->getContents();
            
            // dd($body);  // Muestra el contenido completo de la respuesta
            return base64_encode($body);
        }

        return null;
    } catch (\Exception $e) {
        dd($e->getMessage());  // Captura cualquier error que ocurra durante la solicitud
    }
}

//esta fun me va a traer los datos del manga que se le mando el titulo
public function buscarTituloMangaDex($titulo) {
    $response = Http::get("https://api.mangadex.org/manga", [
        'title' => $titulo,
    ]);

    if ($response->successful()) {
        // Obtener los datos del manga
        $mangaData = $response->json()['data'];

        // Comprobar si hay resultados
        if (!empty($mangaData)) {
            // Retorna el primer manga que coincide
            return $mangaData[0]; // Regresa el primer resultado
        }
    }

    return null; // O maneja el error
}

//sin uso ahun
public function obtenerCapitulosMangaDex($mangaId) {
    $response = Http::get("https://api.mangadex.org/chapter", [
        'manga' => $mangaId,
    ]);

    if ($response->successful()) {
        return $response->json()['data']; // Devuelve los capítulos
    }

    return null; // O maneja el error
}



public function obtenerDetallesMangaPorId($id)
{
    try {
        // Realizamos la solicitud a la API usando el ID del manga
        $response = $this->client->get("{$this->baseUrl}/manga/{$id}", [
            'query' => ['includes[]' => 'cover_art']
        ]);

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody()->getContents());
        }
    } catch (\Exception $e) {
        // Manejar el error de la solicitud
        throw new \Exception('Error al obtener los detalles del manga: ' . $e->getMessage());
    }

    return null; // Retorna null si falla la solicitud
}


    //$endpoint = "https://api.mangadex.org/at-home/server/$id";
    // Este método se encarga de obtener las URLs de las páginas del capítulo dado un ID de capítulo
    public function obtenerUrlsDeCapitulo($id)
{
    // Usamos el ID proporcionado para la solicitud (puedes cambiar este ID por cualquier otro)
    $endpoint = "https://api.mangadex.org/at-home/server/2e348bc4-04bb-422d-878e-ccda4ef1c3b4";

    $client = new \GuzzleHttp\Client();

    try {
        $response = $client->get($endpoint);
        $data = json_decode($response->getBody());

        // Verificamos si existen las imágenes en el capítulo
        if (isset($data->chapter->data)) {
            $baseUrl = $data->baseUrl;
            $hash = $data->chapter->hash;
            $imageUrls = [];

            // Iteramos sobre las imágenes en alta calidad
            foreach ($data->chapter->data as $filename) {
                $imageUrls[] = "$baseUrl/data/$hash/$filename";
            }

            // Puedes retornar las URLs o renderizarlas en una vista
            return view('manga.detalle', ['imageUrls' => $imageUrls]);
        }
    } catch (\Exception $e) {
        // En caso de error, lo logueamos
        Log::error("Error al obtener las imágenes del capítulo: " . $e->getMessage());
    }

    return [];
}



    public function obtenerCapituloPorId($id)
{
    // Realiza la solicitud a la API para obtener el capítulo específico
    $response = $this->client->get("{$this->baseUrl}/chapters/{$id}"); // Ajusta según la API que estés utilizando

    if ($response->getStatusCode() === 200) {
        return json_decode($response->getBody()->getContents());
    }

    return null; // Manejar el error adecuadamente
}


    




}


