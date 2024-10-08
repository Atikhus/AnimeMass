<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesión Iniciada</title>
    <link rel="icon" href="Assets/logo.png" type="Assets/jpg">
    <link rel="stylesheet" href="{{ asset('css/SesionStyle.css') }}">
</head>
<body>
<div class="container">
    <h1>Bienvenido a AnimeMas</h1>
    <p>¡Has iniciado sesión correctamente!</p>

    <!-- Formulario de búsqueda de manga -->
    <form action="{{ url('/sesion_iniciada') }}" method="POST">
        @csrf
        <input type="text" name="titulo" placeholder="Buscar manga" required>
        <button type="submit">Buscar</button>
    </form>

    <!-- Mostrar resultados de la búsqueda solo si hay datos -->
    @if(isset($mangas) && count($mangas->data) > 0)
        <h2>Resultados de la búsqueda</h2>
        <div class="row">
            @foreach($mangas->data as $manga)
                <div class="col-md-4 text-center">
                    @php
                        // Obtener la relación 'cover_art'
                        $cover = collect($manga->relationships)->firstWhere('type', 'cover_art');
                        $coverId = $cover ? $cover->id : null;
                    @endphp

                    @if($coverId)
                        <img src="https://uploads.mangadex.org/covers/{{ $manga->id }}/{{ $coverId }}.jpg" alt="{{ $manga->attributes->title->en }}" class="img-fluid">
                    @else
                        <img src="ruta/imagen/default.jpg" alt="Portada no disponible" class="img-fluid">
                    @endif

                    <h3>{{ $manga->attributes->title->en ?? 'Título no disponible' }}</h3>
                </div>
            @endforeach
        </div>
    @else
        <p>No se encontraron mangas con ese título.</p>
    @endif
</div>
</body>
</html>
