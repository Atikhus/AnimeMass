<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MangaProgress;
use Illuminate\Support\Facades\Auth;


class ProgressController extends Controller
{
    // Método para guardar el progreso del manga
    public function saveProgress(Request $request)
    {
        // Validar los datos entrantes
        $validatedData = $request->validate([
            'manga_id' => 'required|string',
            'url' => 'required|string', // Validar que la URL venga correctamente
        ]);
    
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();
    
        // Guardar o actualizar el progreso del usuario con la URL completa
        $progress = MangaProgress::updateOrCreate(
            ['user_id' => $userId, 'manga_id' => $validatedData['manga_id']],
            ['url' => $validatedData['url']] // Almacenar la URL
        );
    
        return response()->json(['success' => true, 'data' => $progress]);
    }
    
    
    // Método para recuperar el progreso del manga de un usuario
    public function getProgress($mangaId)
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Buscar el progreso del usuario para el manga especificado
        $progress = MangaProgress::where('user_id', $userId)
                                ->where('manga_id', $mangaId)
                                ->first();

        if ($progress) {
            return response()->json([
                'manga_id' => $progress->manga_id,
                'last_page' => $progress->last_page,
            ], 200);
        } else {
            return response()->json(['message' => 'No se encontró progreso para este manga.'], 404);
        }
    }

    

}
