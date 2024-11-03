<div>
    <h2>Comentarios:</h2>
    <h3> cuentanos que tal te parece este manga!</h3>

    <div class="comments-section">
        @foreach($comments as $comment)
        <div class="comment-box">
            <div class="comment-user">{{ $comment->user->name }}</div>
            <div class="comment-text">{{ $comment->comment }}</div>
        </div>
        @endforeach
    </div>

    <form wire:submit.prevent="submitComment">
        <textarea wire:model="newComment" placeholder="Escribe tu comentario..."></textarea>
        <button id="emoji-button">😊</button>
        <button type="submit">Comentar</button>
    </form>
</div>