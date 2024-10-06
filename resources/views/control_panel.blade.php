<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control de Manga</title>
    <link rel="stylesheet" href="css/stile.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>
<body>
    <header>
        <div class="header-content">
            <img src="Assets/logo.png" alt="Logo de Manga Mas" class="logo">
            <h1>Manga Mas</h1>
        </div>
    </header>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="#" data-section="manga-stats">Estadísticas de Manga</a></li>
                <li><a href="#" data-section="mangaka-stats">Estadísticas de Mangakas</a></li>
                <li><a href="#" data-section="reader-stats">Estadísticas de Lectores</a></li>
            </ul>
        </nav>
        <main class="dashboard">
            <section class="dashboard-item" id="manga-stats">
                <h2>Manga Popular</h2>
                <div class="chart-container">
                    <canvas id="mangaChart"></canvas>
                </div>
            </section>
            <section class="dashboard-item" id="mangaka-stats">
                <h2>Mangakas Populares</h2>
                <div class="chart-container">
                    <canvas id="mangakaChart"></canvas>
                </div>
            </section>
            <section class="dashboard-item" id="reader-stats">
                <h2>Edad de Lectores</h2>
                <div class="chart-container">
                    <canvas id="readerChart"></canvas>
                </div>
            </section>
        </main>
    </div>
    <script src="{{ asset('js/avaScrip.js') }}"></script>

    
</body>
</html>