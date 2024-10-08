<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Manga</title>
</head>
<body>
    <div class="container">
        <h1>{{ $manga->attributes->title->en ?? 'Título no disponible' }}</h1>
        <p>{{ $manga->attributes->description->en ?? 'Descripción no disponible' }}</p>

        @php
            $cover = collect($manga->relationships)->firstWhere('type', 'cover_art');
            $coverId = $cover ? $cover->id : null;
        @endphp

        @if($coverId)
            <img src="https://uploads.mangadex.org/covers/{{ $manga->id }}/{{ $coverId }}.jpg" alt="{{ $manga->attributes->title->en }}" class="img-fluid">
        @else
            <img src="ruta/imagen/default.jpg" alt="Portada no disponible" class="img-fluid">
        @endif

        <!-- Aquí puedes agregar más información sobre el manga -->
    </div>
</body>
</html>
