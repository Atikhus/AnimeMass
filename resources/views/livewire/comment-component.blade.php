<div>
    <h3>Comentarios:</h3>

    <div>
        @foreach($comments as $comment)
            <div>
                <strong>{{ $comment->user->name }}</strong>: <span>{{ $comment->comment }}</span>
            </div>
        @endforeach
    </div>

    <form wire:submit.prevent="submitComment">
        <textarea wire:model="newComment" placeholder="Escribe tu comentario..."></textarea>
        <button type="submit">Comentar</button>
    </form>
</div>
