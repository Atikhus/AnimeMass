<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $manga->attributes->title->en }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="/Assets/logo.png">
    @livewireStyles
</head>
<body>
    <div class="banner">
        <img src="/Assets/logo.png" id="banner-image" alt="Banner Manga">
    </div>

    <div class="container">
        <h1>{{ $manga->attributes->title->en }}</h1>

        @php
        $coverArt = collect($manga->relationships)
            ->where("type", "cover_art")
            ->first();
        @endphp

        @if(isset($coverArt) && isset($coverArt->attributes))
            <img src="/Assets/logo.png" id="manga-cover" data-url="https://mangadex.org/covers/{{ $manga->id }}/{{ $coverArt->attributes->fileName }}" alt="Portada de {{ $manga->attributes->title->en ?? 'sin título' }}">
        @else
            <p>No hay portada disponible.</p>
        @endif
        
        <p><strong>Descripción:</strong> {{ $manga->attributes->description->en }}</p>
        
        <button class="btn"><a href="https://mangadex.org/manga/{{ $manga->id }}">Leer Manga</a></button>
        
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script>
            const mangaCoverImg = document.getElementById("manga-cover");
            const bannerImg = document.getElementById("banner-image");
            
            fetch("/api/get_cover?fileurl=" + encodeURIComponent(mangaCoverImg.dataset.url))
            .then(res => res.json())
            .then(json => {
                mangaCoverImg.src = "data:image/jpeg;base64," + json.base64;
                bannerImg.src = "data:image/jpeg;base64," + json.base64;
            });

            /**
             * 
             * 
             * 
             * 
             window.addEventListener('beforeunload', function(event) {
                 const mangaId = "{{$manga->id}}"; // ID del manga
                 const url = window.location.href;
 
                 fetch('/api/save-progress', {
                     method: 'POST',
                     headers: {
                         'Content-Type': 'application/json',
                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                     },
                     body: JSON.stringify({
                         manga_id: mangaId,
                         url: url
                     })
                 }).then(response => {
                     if (!response.ok) {
                         throw new Error('Error en la solicitud');
                     }
                     return response.json();
                 }).catch(error => {
                     console.error('Error al guardar el progreso:', error);
                 });
 
                 event.preventDefault();
             });
             */
        </script>

        <!-- Aquí es donde integrarás el componente de Livewire -->
        @livewire('comment-component', ['mangaId' => $manga->id])
    </div>
    @livewireScripts
</body>
</html>
