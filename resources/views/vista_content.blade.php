<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesión Iniciada</title>
    <link rel="icon" href="{{ asset('Assets/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/SesionStyle.css') }}">    
</head>
<body>
<!-- Header -->
<section class="contenedor-nav">
    <div class="logo">
        <a class="logo-back" href="{{ route('index') }}">
            <img src="{{ asset('Assets/4043233-anime-away-face-no-nobody-spirited_113254.ico') }}" alt="Logo">
        </a>
        <span class="Bienvenido">AnimeMas</span>
    </div>
    <nav>
        <ul>
            <li><a href="#categorias">Categorías</a></li>
            <li><a class="dasboar-color" href="{{ route('control_panel') }}">Dashboard</a></li>
            @auth
                <!-- Botones para usuarios autenticados -->
            @else
                <li><a href="{{ route('sign') }}">Regístrate fácil</a></li>
                <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
            @endauth
        </ul>
    </nav>
    <div class="sesionActiva">
        @auth
            <img src="{{ asset('Assets/dandy.ico') }}" alt="Logo de usuario autenticado">
            <span class="user-name">Bienvenido, {{ Auth::user()->name }}</span>
        @else
            <img src="{{ asset('Assets/dead.ico') }}" alt="Sesión sin iniciar">
        @endauth
    </div>
</section>

<div class="container">
    <h1>Bienvenido a AnimeMas</h1>
    <p>¡Tu aventura comienza aquí! Detrás de cada página hay un nuevo mundo por descubrir. ¿Estás listo para desvelar los secretos de tus mangas favoritos?</p>
    <p>es una sorpresa dejate sorprender!</p>

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
        <input type="text" name="titulo" placeholder="Buscar manga...">
        <button type="submit">Buscar</button>
    </form>

    <!-- Mostrar resultados de la búsqueda -->
    <div class="manga-grid">
        @if(isset($mangas) && count($mangas) > 0)
            @foreach($mangas as $manga)
                <div class="manga-item">
                    <h2>
                        <a href="{{ route('manga.detalle', $manga['id']) }}">
                        {{ $manga['attributes']['title']['en'] ?? 'Título no disponible' }}
                        </a>
                    </h2>
                    <!-- Mostrar la imagen de portada del manga -->
                    @if(isset($manga['cover_url']))
                        <img src="{{ $manga['cover_url'] }}" alt="Cover de {{ $manga['attributes']['title']['en'] ?? 'Manga' }}" width="200">
                    @else
                        <p>No cover disponible</p>
                    @endif
                </div>
            @endforeach
        @else
            <p>No se encontraron mangas.</p>
        @endif
    </div>
</div>
</body>
</html>
