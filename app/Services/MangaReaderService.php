<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
class MangaReaderService
{
    private $client;
    private $baseUrl = 'https://api.jikan.moe/v4/manga'; // Base URL sin 'featured'

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getMangas()
    {
        // Realizar la solicitud para obtener mangas destacados
        $response = $this->client->get("{$this->baseUrl}/"); // Aquí usamos '/featured'

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody()->getContents()); // Retorna los datos de los mangas
        }

        return null; // Retorna null si la solicitud falla
    }

    public function buscarMangaPorTitulo($titulo)
{
    try {
        $response = $this->client->get("{$this->baseUrl}", [
            'query' => ['q' => $titulo],
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


    


public function obtenerDetallesMangaPorId($id)
{
    try {
        // Realizamos la solicitud a la API usando el ID del manga
        $response = $this->client->get("{$this->baseUrl}/{$id}");

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