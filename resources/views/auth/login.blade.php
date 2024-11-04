<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Assets/4043233-anime-away-face-no-nobody-spirited_113254.png">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main class="container">
        <div class="container-poster">
        <img src="Assets/4043233-anime-away-face-no-nobody-spirited_113254.ico" alt="">
            <h1>¡Bienvenido!</h1>
            <p>Únete a nosotros</p>
        </div>

        <!-- Formulario -->
        <div class="container-formulario">
            <h2>Iniciar sesión</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf <!-- Protección CSRF -->
                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" placeholder="example@gmail.com" required pattern="^([\w]*[\w\.]*(?!\.)@gmail.com)">
                </div>
                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <div>
                    <label for="recordar">
                        <input type="checkbox" id="recordar" name="remember"> Recordarme
                    </label>
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </div>
                <input class="btn" type="submit" value="Iniciar">
            </form>

            <span>¿No tienes una cuenta? <a href="sign">Regístrate</a></span>
        </div>
    </main>
</body>
</html>
