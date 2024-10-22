<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $manga->attributes->title->en }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="/Assets/logo.png">
</head>
<body>
    <!-- Banner dinámico arriba -->
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
        
        <!-- Botón para leer manga -->
        <button class="btn"><a href="https://mangadex.org/manga/{{ $manga->id }}">Leer Manga</a></button>

        <script>
            const mangaCoverImg = document.getElementById("manga-cover");
            const bannerImg = document.getElementById("banner-image");

            // Fetch para cargar la portada del manga
            fetch("/api/get_cover?fileurl=" + encodeURIComponent(mangaCoverImg.dataset.url))
                .then(res => res.json())
                .then(json => {
                    mangaCoverImg.src = "data:image/jpeg;base64," + json.base64;
                });

            // Fetch para cargar la misma portada como banner en la parte superior
            fetch("/api/get_cover?fileurl=" + encodeURIComponent(mangaCoverImg.dataset.url))
                .then(res => res.json())
                .then(json => {
                    bannerImg.src = "data:image/jpeg;base64," + json.base64;
                });
        </script>
    </div>
</body>
</html>
