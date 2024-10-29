<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnimeMas</title>

    <link rel="icon" href="Assets/logo.png" type="Assets/jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/estilos-home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

    <header id="inicio">
        <input type="checkbox" id="menu">
        <label for="menu" class="hamburger">
            <span class="barras">≡</span>
            <span class="equis">x</span>
        </label>
        <section class="contenedor-nav">
            <div class="logo">
                <img src="Assets/logo.png" alt="logo">
                <span>AnimeMas</span>
            </div>
            <form  class="search-form">
                <input type="text" class="search-input" placeholder="Buscar aquí">
                <button type="submit" class="search-btn"><a href="{{ route('login') }}">
                
                    <i class="fas fa-search"><a href="{{route('sesion_iniciada')}}">buscar mangas</a></i>
                </a>
                </button>

            </form>
            <nav>
                <ul>
                    <li><a href="#inicio">Home</a></li>
                    <li><a href="#descubre">Descubre</a></li>
                    <li><a href="#categorias">Categorías</a></li>
                    <li><a href="{{ route('control_panel') }}">Dashboard</a></li>
                    
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
                    <span class="Bienvenido" >Bienvenido, {{ Auth::user()->name}}</span>
                    

                @else
                    <!-- Mostrar espacio vacío si no ha iniciado sesión -->
                    <img src="{{ asset('Assets/dead.ico')}}" alt="sesion sin inciar">
                @endauth
            </div>
        </section>
        <section class="textos-header">
            <h1>ANIMEMAS</h1>
            <p> En nuestra aplicación web, invitamos a todos los fanáticos del manga, tanto veteranos 
                como nuevos, a sumergirse en nuestro extenso catálogo de los mejores títulos disponibles.
                Aquí podrás explorar, descubrir nuevas aventuras y disfrutar de una experiencia de lectura única 
                con historias que van desde los clásicos del manga hasta las últimas novedades.

                ¡Navega ahora y encuentra el manga perfecto para ti!</p>
            <a href="{{route('sesion.iniciada')}}">Descubre más ➟</a>
        </section>
    </header>
    <section id="descubre" class="anime-section">
        <h1>¡Descubre Mangas!</h1>
        <p>¡Disfruta aquí de algunos de nuestros títulos más populares!</p>
        <div class="anime-grid">
            <div class="anime-card">
                <img src="Assets/descrube1.webp" alt="Soul Eater">
                <h2>Dungeon ni Hisomu Yandere</h2>
                <p>Sub | Dob</p>
            </div>
            <div class="anime-card">
                <img src="Assets/descubre2.webp" alt="BOCCHI THE ROCK!">
                <h2>Uzaki-chan wa Asobitai</h2>
                <p>Subtitulado</p>
            </div>
            <div class="anime-card">
                <img src="Assets/descubre3.webp" alt="The Reincarnation Of The Strongest Exorcist In Another World">
                <h2>El hijo menor del maestro de la espada</h2>
                <p>Sub | Dob</p>
            </div>
            <div class="anime-card">
                <img src="Assets/descubre4.webp" alt="Horimiya">
                <h2>Academy genius swordsman</h2>
                <p>Sub | Dob</p>
            </div>
            <div class="anime-card">
                <img src="Assets/descubre5.webp" alt="Campfire Cooking in Another World with My Absurd Skills">
                <h2>The New Gate</h2>
                <p>Sub | Dob</p>
            </div>
        </div>
    </section>
    <section id="categorias" class="category-section">
        <h1>¿Qué te gustaría leer hoy?</h1>
        <div class="category-grid">
            <div class="category-card">
                <img src="Assets/shunen.webp" alt="Shonen">
                <div class="category-overlay">
                    <span>Shonen</span>
                </div>
            </div>
            <div class="category-card">
                <img src="Assets/shojo.jpg" alt="Shojo">
                <div class="category-overlay">
                    <span>Shojo</span>
                </div>
            </div>
            <div class="category-card">
                <img src="Assets/seinen.jpg" alt="Seinen">
                <div class="category-overlay">
                    <span>Seinen</span>
                </div>
            </div>
            <div class="category-card">
                <img src="Assets/novelagrafica.jpg" alt="Novela Gráfica">
                <div class="category-overlay">
                    <span>Novela Gráfica</span>
                </div>
            </div>
            <div class="category-card">
                <img src="Assets/bl.jpg" alt="BL">
                <div class="category-overlay">
                    <span>BL</span>
                </div>
            </div>
            <div class="category-card">
                <img src="Assets/echi.jpg" alt="Ecchi">
                <div class="category-overlay">
                    <span>Ecchi</span>
                </div>
            </div>
            <div class="category-card">
                <img src="Assetsspokon.jpg" alt="Spokon">
                <div class="category-overlay">
                    <span>Spokon</span>
                </div>
            </div>
            <div class="category-card">
                <img src="Assets/superheroes.jpg" alt="Superhéroes">
                <div class="category-overlay">
                    <span>Superhéroes</span>
                </div>
            </div>
            <div class="category-card">
                <img src="Assets/yuri.jpg" alt="Yuri">
                <div class="category-overlay">
                    <span>Yuri</span>
                </div>
            </div>
            <div class="category-card">
                <img src="Assets/romcom.jpg" alt="Romcom">
                <div class="category-overlay">
                    <span>Romcom</span>
                </div>
            </div>
        </div>
    </section>

    <section id="registro" class="valores">
        <div class="section">
            <h3>Sigue los siguientes pasos</h3>
            <h1>Regístrate fácil </h1>
            <p>
                A continuación, te presentamos los pasos a seguir para que quedes registrado
                en nuestra aplicación web, donde podrás disfrutar y tener acceso a los mejores mangas.
                Presta atención y no te pierdas la oportunidad de registrarte!!. 
            </p>
            <ul>
                <li>porfavor ve a la parte superior esta ubicado el boton de Registrate facil ve ahi</li>
                <li>te llevara al formulario, completalo</li>
                <li>luego inicia sesion con tus datos </li>
                <li>y disfruta de todo lo que tiene AnimeMas para ofrecerte!</li>
            </ul>
    </section>

    <footer class="footer">
        <div class="social-icons">
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
        </div>
        <p>&copy; 2024 AnimeMas. Todos los derechos reservados.</p>
        
    <p>Este sitio utiliza la API de MangaDex para obtener información de manga. Gracias a <a href="https://mangadex.org/" target="_blank">MangaDex</a> por proporcionar el acceso a su contenido.</p>
    <p><em>El contenido y las imágenes son propiedad de sus respectivos creadores y editores.</em></p>
    </footer>

</body>

</html>
