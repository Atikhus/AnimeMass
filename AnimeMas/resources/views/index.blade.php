<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="Assets/4043233-anime-away-face-no-nobody-spirited_113254.png"> 
    <link rel="icon" href="{{ asset('Assets/4043233-anime-away-face-no-nobody-spirited_113254.png')}}">
    <title>AnimeMas</title>
</head>
<body>
    <!-- Sección principal -->
    <div class="section hero" style="background-color: var(--bg-color);">
        <div class="container">
            <div class="grid" style="grid-template-columns: 1fr 1fr;">
                <div>
                    <img src="Assets/tumblr_mfjzykj7nh1ro8cnpo1_500.webp" alt="">
                    <h1>Descubre el mundo del manga</h1>
                    <p> sumergete tu mismo en atrapantes historias  y vibrantes ilustraciones del universo del manga</p>
                    <a href="#" class="btn">Explora ahora</a>
                </div>
                <div>
                    <img src="/placeholder.svg" alt="Manga Hero">
                </div>
            </div>
        </div>
    </div>

    <!-- Sección Featured Manga -->
    <div class="section" style="background-color: #3a0365;">
        <div class="container">
            <h2>Featured Manga</h2>
            <div class="grid" style="grid-template-columns: repeat(4, 1fr);">
                <!-- Tarjetas de Manga -->
                <div class="card">
                    <img src="/placeholder.svg" alt="Attack on Titan">
                    <div class="card-body">
                        <h3>Attack on Titan</h3>
                        <p>En un mundo donde la humanidad vive asustada de las criaturas  gigantes humanoides conocidas como titanes... </p>
                    </div>
                </div>
                <div class="card">
                    <img  class="Naruto" src="Assets/naruto_icon.png" alt="Naruto">
                    <div class="card-body">
                        <h3>Naruto</h3>
                        <p> Sigue las aventuras de Naruto Uzumaki, un nunja joven entrenando </p>
                    </div>
                </div>
                <div class="card">
                    <img src="/placeholder.svg" alt="One Piece">
                    <div class="card-body">
                        <h3>One Piece</h3>
                        <p> Monkey D. Luffy se propone una jornada de busqueda del legendario tesoro </p>
                    </div>
                </div>
                <div class="card">
                    <img src="/placeholder.svg" alt="My Hero Academia">
                    <div class="card-body">
                        <h3>My Hero Academia</h3>
                        <p> En un mundo donded la gente desarrollo superpoderes, un joven chico sueña con convertirse en un heroe...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Últimas Actualizaciones -->
    <div class="section" style="background-color: var(--bg-color);">
        <div class="container">
            <h2>Ultimas actualizaciones</h2>
            <div class="grid" style="grid-template-columns: repeat(3, 1fr);">
                <!-- Tarjetas de Actualizaciones -->
                <div class="card">
                    <img src="/placeholder.svg" alt="Update 1">
                    <div class="card-body">
                        <h3>Nueva serie de mangas anunciados</h3>
                        <p>The publishing company has just announced the launch of a brand-new manga series...</p>
                        <a href="#" class="btn" style="background-color: transparent; color: var(--button-color); padding: 0;">Read More</a>
                    </div>
                </div>
                <div class="card">
                    <img src="/placeholder.svg" alt="Update 2">
                    <div class="card-body">
                        <h3> El premio al mejor artista de manga</h3>
                        <p> el renovado artista de manga ha sido reconocido...</p>
                        <a href="#" class="btn" style="background-color: transparent; color: var(--button-color); padding: 0;">Read More</a>
                    </div>
                </div>
                <div class="card">
                    <img src="/placeholder.svg" alt="Update 3">
                    <div class="card-body">
                        <h3> Adactacion del manga anunciado!!!</h3>
                        <p>Los fanáticos de la querida serie de novelas están encantados de saber que una adaptación al manga...</p>
                        <a href="#" class="btn" style="background-color: transparent; color: var(--button-color); padding: 0;">Read More</a>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>

<!-- Contenedor del footer -->
<div class="footer-container">
    <div class="footer">
        <!-- Contenido del footer -->
        <footer>
            <p >informacion:</p>
            <p >contacto: 3206717199</p>
            <p >informacion:luis miguel moreno potes</p>
            <p >informacion:tecnologia en sistemas</p>
        </footer>
    </div>
</div>

    
</body>
</html>