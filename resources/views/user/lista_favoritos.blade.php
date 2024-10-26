<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Assets/logo.png" type="Assets/jpg">
    <link rel="stylesheet" href="css/user_style.css">
    <title>Lista de Mangas Favoritos</title>
</head>
<body>
    <header class="header-container"></header>

    <section class="section-list">
        <div class="list-container">
            <h1><img src="Assets/add_mark_like_save_label_book_bookmark_icon_219290.ico" alt="">Mi lista</h1>
            <p>favoritos</p>
            
            
            <!-- Contenedor de la lista -->
            <ul id="user-links-list">
    <!-- Aquí se añadirán los enlaces dinámicamente -->
</ul>


            <!-- Incluye el script externo -->
            <script src="{{ asset('js/list_favorite.js') }}"></script>
        </div>
    </section>
</body>
</html>
