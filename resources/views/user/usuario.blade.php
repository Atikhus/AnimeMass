//usuario funcional:
<!-- usuario.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario Perfil</title>
    <link rel="stylesheet" href=""> <!-- Ruta de tus estilos CSS -->
</head>
<body>
    <!-- Este es el div que quieres cargar en control_panel.html -->
    <div id="div-que-quiero-cargar">
        
        <div class="caja-contenedora">
    <div>
        <img src="{{ asset('Assets/dandy.ico') }}" alt="Logo de usuario autenticado">
        <span class="Bienvenido" >Bienvenido, {{ Auth::user()->name}}</span>
    </div>
    <div class="box-favorite-list">
        <a href="/lista_favoritos">Lista mangas favorito</a>
    </div>
    
    
    <div class="box-x">
    <a href="dashboard">actualiza tus datos</a>
    </div>
</div>
</div>

</div>

</body>
</html>
