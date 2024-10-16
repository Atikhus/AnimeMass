<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Manga</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>{{ $mangaDetalle->data->title }}</h1>
        
        <h2>Información General</h2>
        <p><strong>Título en Inglés:</strong> {{ $mangaDetalle->data->title_english ?? 'No disponible' }}</p>
        <p><strong>Título en Japonés:</strong> {{ $mangaDetalle->data->title_japanese ?? 'No disponible' }}</p>
        <p><strong>Estado:</strong> {{ $mangaDetalle->data->status ?? 'No disponible' }}</p>
        <p><strong>Chapters:</strong> {{ $mangaDetalle->data->chapters ?? 'No disponible' }}</p>
        <p><strong>Volúmenes:</strong> {{ $mangaDetalle->data->volumes ?? 'No disponible' }}</p>
        <p><strong>Calificación:</strong> {{ $mangaDetalle->data->score ?? 'No disponible' }}</p>
        
        <h2>Sinopsis</h2>
        <p>{{ $mangaDetalle->data->synopsis ?? 'No disponible' }}</p>

        <h2>Detalles de Publicación</h2>
        <p><strong>Publicado desde:</strong> {{ $mangaDetalle->data->published->string ?? 'No disponible' }}</p>

        <h2>Autores</h2>
        <ul>
            @foreach ($mangaDetalle->data->authors as $author)
                <li><a href="{{ $author->url }}">{{ $author->name }}</a></li>
            @endforeach
        </ul>

        <h2>Géneros</h2>
        <ul>
            @foreach ($mangaDetalle->data->genres as $genre)
                <li>{{ $genre->name ?? 'No disponible' }}</li>
            @endforeach
        </ul>

        <h2>Imágenes</h2>
        <div>
            <img src="{{ $mangaDetalle->data->images->jpg->image_url ?? '#' }}" alt="{{ $mangaDetalle->data->title }} (JPG)">
            <img src="{{ $mangaDetalle->data->images->webp->image_url ?? '#' }}" alt="{{ $mangaDetalle->data->title }} (WEBP)">
        </div>

        <h2><a href="{{ $mangaDetalle->data->url }}" target="_blank">Más detalles en MyAnimeList</a></h2>
    </div>
</body>
</html>
