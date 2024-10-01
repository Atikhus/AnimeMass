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
            <h1>bienvenido!</h1>
            <p>unete a  nosotros</p>
        </div>

        <div class="container-formulario">
            <h2>sign up</h2>
            <form method="{{ route('sign.process') }}" action="POST">
    @csrf <!-- Protección CSRF -->
    <input type="text" name="name" placeholder="Nombre" required>
    <input type="text" name="lastname" placeholder="Apellido" required>
    <input type="email" name="email" placeholder="example@gmail.com" required pattern="^([\w]*[\w\.]*(?!\.)@gmail.com)">
    <input type="password" name="password" placeholder="Contraseña" required>
    <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" required> <!-- Este campo es necesario -->
    <input class="btn" type="submit" value="Registrar">
</form>



        </div>

    </main>
</body>
</html>