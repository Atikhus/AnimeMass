<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $manga->attributes->title->en }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="/Assets/logo.png">
    @livewireStyles
</head>
<body>
    <div class="banner">
        <img src="/Assets/logo.png" id="banner-image" alt="Banner Manga">
    </div>


    <!--logo de ir atras-->
    <a  class="logo-back"  href="{{ route('sesion_iniciada') }}"><img   src="{{ asset('Assets/4043233-anime-away-face-no-nobody-spirited_113254.ico') }}" alt=""></a>
    
    <!--contenedor de las imagenes-->
    <div class="container">
        <h1>{{ $manga->attributes->title->en }}</h1>

        <!--trae los covers del backend-->
        @php
        $coverArt = collect($manga->relationships)
            ->where("type", "cover_art")
            ->first();
        @endphp

        @if(isset($coverArt) && isset($coverArt->attributes))
            <img src="/Assets/logo.png" id="manga-cover" data-url="https://mangadex.org/covers/{{ $manga->id }}/{{ $coverArt->attributes->fileName }}" alt="Portada de {{ $manga->attributes->title->en ?? 'sin título' }}">
        @else
            <p>No hay portada disponible.</p>
        @endif
        
        <p><strong>Descripción:</strong> {{ $manga->attributes->description->en ?? $manga->attributes->description->ja ?? 'Descripción no disponible' }}</p>
        <p><strong>genero:</strong> {{ $manga->attributes->publicationDemographic }}</p>
        <p><strong>año:</strong> {{ $manga->attributes->year }}</p>
        <p><strong>estado:</strong> {{ $manga->attributes->status }}</p>
        <p><strong>emicion:</strong> {{ $manga->attributes->state }}</p>
        <button class="btn"><a href="https://mangadex.org/manga/{{ $manga->id }}">Leer Manga</a></button>
        <div>


            <!--seccion espcial para enviar los datos de la url de esta pagina con su id para la base de datos -->
            <h1><img src="/Assets/add_mark_like_save_label_book_bookmark_icon_219290.ico" alt="/Assets/logo.png"></h1>
            <button  id="saveMangaButton"        
            data-manga-id="{{ $manga->id }}" 
            data-manga-title="{{ $manga->attributes->title->en }}">
            
                Agregar a lista de favoritos
                
            </button>
            

        
        <script>
            const mangaCoverImg = document.getElementById("manga-cover");
            const bannerImg = document.getElementById("banner-image");
            
            fetch("/api/get_cover?fileurl=" + encodeURIComponent(mangaCoverImg.dataset.url))
            .then(res => res.json())
            .then(json => {
                mangaCoverImg.src = "data:image/jpeg;base64," + json.base64;
                bannerImg.src = "data:image/jpeg;base64," + json.base64;
            });

            /**
             * 
             * 
             * 
             * 
             window.addEventListener('beforeunload', function(event) {
                 const mangaId = "{{$manga->id}}"; // ID del manga
                 const url = window.location.href;
 
                 fetch('/api/save-progress', {
                     method: 'POST',
                     headers: {
                         'Content-Type': 'application/json',
                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                     },
                     body: JSON.stringify({
                         manga_id: mangaId,
                         url: url
                     })
                 }).then(response => {
                     if (!response.ok) {
                         throw new Error('Error en la solicitud');
                     }
                     return response.json();
                 }).catch(error => {
                     console.error('Error al guardar el progreso:', error);
                 });
 
                 event.preventDefault();
             });
             */
        </script>

        <!-- Aquí es donde integrarás el componente de Livewire  para mostrar los comentarios-->
        
        @livewire('comment-component', ['mangaId' => $manga->id])
    </div>
    @livewireScripts
    <script src="{{ asset('js/detalles.js') }}"></script>

</body>
</html>