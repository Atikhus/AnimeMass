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

        <div class="container-formulario">
            <h2>login</h2>
            <form action="" method=""><!--este lleva toda la info recogida al servidor-->
                <input type="email" name="email" placeholder="example@gmail.com" required pattern="^([\w]*[\w\.]*(?!\.)@gmail.com)"> <!--el patern es para obligar a que el formato sea @gmail.com-->
                <input type="password" name="contraseña" placeholder="contraseña" required>
                <label for="">
                    <input type="checkbox" name="recordar">recordarme
                </label>
                <a href="">¿olvidaste tu contraseña?</a>
                <input class="btn" type="submit" value="iniciar" >
            </form>
            <span>¿no tienes una cuenta? <a href="sign.html">registrate</a></span>
        </div>

    </main>
</body>
</html>