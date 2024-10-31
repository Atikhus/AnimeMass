<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLink;

class CommentComponent extends Component
{
    public $mangaId;
    public $comments = [];
    public $newComment;

    public function mount($mangaId)
    {
        $this->mangaId = $mangaId;
        $this->comments = Comment::with('user')->where('manga_id', $this->mangaId)->get();
    }

    public function submitComment()
    {
        $this->validate([
            'newComment' => 'required|string|max:255',
        ]);

        Comment::create([
            'manga_id' => $this->mangaId,
            'user_id' => Auth::id(), 
            'comment' => $this->newComment, // Asegúrate de que el campo se llame 'comment'
        ]);

        // Recarga los comentarios después de agregar uno nuevo
        $this->comments = Comment::where('manga_id', $this->mangaId)->get();
        $this->newComment = '';
    }

    


    public function render()
    {
        return view('livewire.comment-component');
    }
}
