<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Manga Reader</title>
</head>
<body>
    <div id="manga-feed"></div>

    <script>
        function loadMangaFeed(mangaId) {
            fetch(`http://127.0.0.1:8000/api/manga/${mangaId}/feed`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la red');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    displayMangaFeed(data.data);
                })
                .catch(error => {
                    console.error('Error al cargar el feed del manga:', error);
                });
        }

        function displayMangaFeed(chapters) {
            const feedContainer = document.getElementById('manga-feed');
            chapters.forEach(chapter => {
                const chapterElement = document.createElement('div');
                chapterElement.innerHTML = `
                    <h3>Capítulo ${chapter.attributes.volume || ''} - ${chapter.attributes.chapter}</h3>
                    <p>Publicación: ${chapter.attributes.publishAt}</p>
                    <p>Idioma: ${chapter.attributes.translatedLanguage}</p>
                `;
                feedContainer.appendChild(chapterElement);
            });
        }

        // Llama a la función con el ID del manga
        loadMangaFeed('6b1eb93e-473a-4ab3-9922-1a66d2a29a4a');
    </script>
</body>
</html>
