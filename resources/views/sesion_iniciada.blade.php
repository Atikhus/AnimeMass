<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesión Iniciada</title>
    <link rel="icon" href="Assets/logo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/SesionStyle.css') }}">    
</head>
<body>
<div class="container">
    <h1>Bienvenido a AnimeMas</h1>
    <p>¡Has iniciado sesión correctamente!</p>

    <!-- Mensajes de error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario de búsqueda de manga -->
    <form action="{{ route('buscar.manga') }}" method="POST">
        @csrf
        <input type="text" name="titulo" placeholder="Buscar manga..."> <!-- Cambiado de 'search' a 'titulo' -->
        <button type="submit">Buscar</button>
    </form>

    <!-- Mostrar resultados de la búsqueda solo si hay datos -->
    @if(isset($mangas) && count($mangas) > 0)
        @foreach($mangas as $manga)
        @php
        $coverArt = collect($manga->relationships)
            ->where("type", "cover_art")
            ->first()
        @endphp
        <div>
            <h2>
                <a href="{{ route('manga.detalle', $manga->id) }}">
                    {{ $manga->attributes->title->en ?? 'Título no disponible' }}
                </a>
            </h2>
            @if(isset($coverArt))
                <img src="" class="manga-cover" data-url="https://mangadex.org/covers/{{ $manga->id }}/{{ $coverArt->attributes->fileName }}" alt="Portada de {{ $manga->attributes->title->en ?? 'sin título' }}">
            @else
                <p>No hay portada disponible.</p>
            @endif
        </div>
        @endforeach
    @else
        <p>No se encontraron mangas.</p>
    @endif

    <script>
        const imgs = document.getElementsByClassName("manga-cover");

        for (const img of imgs) {
            fetch("/api/get_cover?fileurl=" + encodeURIComponent(img.dataset.url))
                .then(res => res.json())
                .then(json => {
                    img.src = "data:image/jpeg;base64," + json.base64;
                })
        }
    </script>

</div>
</body>
</html>
