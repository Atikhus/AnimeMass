<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Assets/4043233-anime-away-face-no-nobody-spirited_113254.png">
    <title>login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main class="container">
        <div class="conainer-poster" >
            <h1>bienvenido!</h1>
            <p>unete a  nosotros</p>
        </div>

        <!--formulario -->
        <div class="container-formulario">
            <h2>login</h2>
            <form method="POST" action="{{ route('login.process') }}">
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
            <input type="checkbox" id="recordar" name="recordar"> Recordarme
        </label>
        <a href="">¿Olvidaste tu contraseña?</a>
    </div>
    <input class="btn" type="submit" value="Iniciar">
</form>

            <span>¿no tienes una cuenta? <a href="sign">registrate</a></span>
        </div>

    </main>
</body>
</html>