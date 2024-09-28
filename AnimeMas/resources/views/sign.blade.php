<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <link rel="stylesheet" href="css/sign.css">
</head>
<body>
    <main class="container">
        <div class="conainer-poster" >
            <h1>bienvenido!</h1>
            <p>unete a  nosotros</p>
        </div>

        <div class="container-formulario">
            <h2>sign up</h2>
            <form action="" method=""><!--este lleva toda la info recogida al servidor-->
                <input type="text" name="nombre" placeholder="nombre" required> <!--el dato se guarda en la variable nombre, y el required obiga que el campo este lleno -->
                <input type="text" name="lastname" placeholder="Apellido" required>
                <input type="email" name="email" placeholder="example@gmail.com" required pattern="^([\w]*[\w\.]*(?!\.)@gmail.com)"> <!--el patern es para obligar a que el formato sea @gmail.com-->
                <input type="password" name="contraseña" placeholder="contraseña" required>
                <input class="btn" type="submit" value="Registrar" >
                
            </form>
        </div>

    </main>
</body>
</html>