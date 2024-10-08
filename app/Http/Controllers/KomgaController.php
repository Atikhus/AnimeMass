<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class KomgaController extends Controller{

    public function getSeries() {
    
        $response = Http::withBasicAuth('admin', 'password') // Tus credenciales de Komga
                        ->get('http://localhost:8080/api/v1/series');

        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            $series = $response->json();
            return view('komga.series', ['series' => $series]);
        }

        return back()->with('error', 'No se pudo obtener las series');
    }
}
