<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Método para obtener todos los comentarios de un manga específico
    public function index($mangaId)
    {
        $comments = Comment::where('manga_id', $mangaId)->with('user')->get();

        return response()->json($comments);
    }

    // Método para almacenar un nuevo comentario (si decides usarlo con API)
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'manga_id' => 'required|exists:manga,id',
            'comment' => 'required|string|max:1000',
        ]);

        $comment = Comment::create($request->all());

        return response()->json($comment, 201);
    }
}
