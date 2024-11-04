<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <link rel="stylesheet" href="css/sign.css">
    <link rel="icon" href="Assets/logo.png">
</head>
<body>
    <main class="container">
        <div class="conainer-poster" >
            <img src="Assets/4043233-anime-away-face-no-nobody-spirited_113254.ico" alt="">
            <h1>bienvenido!</h1>
            <p>unete a  nosotros</p>
        </div>

        <div class="container-formulario">
            <h2>sign up</h2>
            <form method="POST" action="{{ route('sign.process') }}">
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div>
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" placeholder="Nombre" required>
    </div>
    <div>
        <label for="lastname">Apellido:</label>
        <input type="text" id="lastname" name="lastname" placeholder="Apellido" required>
    </div>
    <div>
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" placeholder="example@gmail.com" required pattern="^([\w]*[\w\.]*(?!\.)@gmail.com)">
    </div>
    <div>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Contraseña" required>
    </div>
    <div>
        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña" required>
    </div>
    <input class="btn" type="submit" value="Registrar">
</form>



        </div>

    </main>
</body>
</html>