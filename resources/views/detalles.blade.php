<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $manga->attributes->title->en }} - Detalles</title>
    <link rel="stylesheet" href="{{ asset('css/SesionStyle.css') }}">
</head>
<body>
    <header>
        <h1>{{ $manga->attributes->title->en }}</h1>
        <a href="{{ route('sesion_iniciada') }}">Regresar a la búsqueda</a>
    </header>

    <main>
        <section>
            <h2>Descripción</h2>
                <p>{{ isset($manga->attributes->description->en) ? htmlspecialchars($manga->attributes->description->en) : 'Descripción no disponible' }}</p>
        </section>

        <section>
            <h2>Imágenes del Manga</h2>
            <div class="imagen-container">
                @if(isset($imagenes) && count($imagenes) > 0)
                    @foreach($imagenes as $imagen)
                        <div class="imagen-item">
                            <img src="{{ $imagen['url'] }}" alt="Imagen de {{ $manga->attributes->title->en }}" class="imagen-manga">
                        </div>
                    @endforeach
                @else
                    <p>No hay imágenes disponibles para este manga.</p>
                @endif
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Tu Plataforma de Manga. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
