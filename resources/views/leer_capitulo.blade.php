<!-- resources/views/manga/leer_capitulo.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Manga - Leer Capítulo</title>
    <link rel="stylesheet" href="{{ asset('css/SesionStyle.css') }}">
</head>
<body>
    <h1>Imágenes del Capítulo</h1> 

    @if(!empty($imageUrls))
        @foreach($imageUrls as $imageUrl)
            <div>
                <img src="{{ $imageUrl }}" alt="Página del Manga" style="max-width: 100%; height: auto;">
            </div>
        @endforeach
    @else
        <p>No hay imágenes disponibles para este capítulo.</p>
    @endif
</body>
</html>
