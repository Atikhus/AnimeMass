<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categorias</title>
    <link rel="icon" href="Assets/logo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/SesionStyle.css') }}">    
</head>
<body>
<!--header -->
<section class="contenedor-nav">
            <div class="logo">
                <!--logo de ir atras-->
<a class="logo-back"  href="{{ route('index') }}"><img   src="{{ asset('Assets/4043233-anime-away-face-no-nobody-spirited_113254.ico') }}" alt=""></a>
                <span class="Bienvenido" >AnimeMas</span>
            </div>
            
            <nav>
                <ul>
                    
                    <li><a href="#categorias">Categorías</a></li>
                    <li><a class="dasboar-color" href="{{ route('control_panel') }}">Dashboard</a></li>
                    
                    @auth
                        <!-- Si el usuario ha iniciado sesión, no mostramos los botones de inicio de sesión -->
                    @else
                        <li><a href="{{ route('sign') }}">Registrate fácil</a></li>
                        <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                    @endauth
                </ul>
            </nav>
            <div class="sesionActiva">
                @auth
                    <!-- Mostrar el logo y el mensaje de bienvenida si el usuario ha iniciado sesión -->
                    
                    <img src="{{ asset('Assets/dandy.ico') }}" alt="Logo de usuario autenticado">
                    <span class="user-name" >Bienvenido, {{ Auth::user()->name}}</span>
                    

                @else
                    <!-- Mostrar espacio vacío si no ha iniciado sesión -->
                    <img src="{{ asset('Assets/dead.ico')}}" alt="sesion sin inciar">
                @endauth
            </div>
        </section>

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
<form id="auto-submit-form" action="{{ route('buscar.manga') }}" method="POST">
        @csrf
        <input type="text" name="titulo" placeholder="Buscar manga..." value="{{ $genreName ?? '' }}">
        <button type="submit">Buscar</button>
    </form>

<!-- Script para enviar el formulario automáticamente al cargar la página -->
<script>
        // Espera a que el contenido de la página esté completamente cargado
        window.addEventListener('DOMContentLoaded', function() {
            document.getElementById('auto-submit-form').submit();
        });
    </script>


    <!-- Mostrar resultados de la búsqueda solo si hay datos -->
    <div class="manga-grid">
        @if(isset($mangas) && count($mangas) > 0)
            @foreach($mangas as $manga)
            @php
            $coverArt = collect($manga->relationships)
                ->where("type", "cover_art")
                ->first();
            @endphp
            <div class="manga-item">
                @if(isset($coverArt))
                    <img src="/Assets/logo.png" class="manga-cover" data-url="https://mangadex.org/covers/{{ $manga->id }}/{{ $coverArt->attributes->fileName }}" alt="Portada de {{ $manga->attributes->title->en ?? 'sin título' }}">
                @else
                    <p>No hay portada disponible.</p>
                @endif
                <h2>
                    <a href="{{ route('manga.detalle', $manga->id) }}">
                        {{ $manga->attributes->title->en ?? 'Título no disponible' }}
                    </a>
                </h2>
            </div>
            @endforeach
        @else
            <p>No se encontraron mangas.</p>
        @endif
    </div>

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
