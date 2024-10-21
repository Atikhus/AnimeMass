<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $manga->attributes->title->en }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>{{ $manga->attributes->title->en }}</h1>

        @php
        $coverArt = collect($manga->relationships)
            ->where("type", "cover_art")
            ->first();
        @endphp

        @if(isset($coverArt) && isset($coverArt->attributes))
            <img src="" id="manga-cover" data-url="https://mangadex.org/covers/{{ $manga->id }}/{{ $coverArt->attributes->fileName }}" alt="Portada de {{ $manga->attributes->title->en ?? 'sin título' }}">
        @else
            <p>No hay portada disponible.</p>
        @endif
        
        <p><strong>Descripción:</strong> {{ $manga->attributes->description->en }}</p>
        
        <a href="https://mangadex.org/manga/{{ $manga->id }}">leer manga</a>

        <script>
            const img = document.getElementById("manga-cover");

            fetch("/api/get_cover?fileurl=" + encodeURIComponent(img.dataset.url))
                .then(res => res.json())
                .then(json => {
                    img.src = "data:image/jpeg;base64," + json.base64;
                })
        </script>
</body>
</html>
