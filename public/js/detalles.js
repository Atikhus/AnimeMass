document.addEventListener('DOMContentLoaded', function () {
    const saveButton = document.querySelector('#saveMangaButton');
    
    if (saveButton) {
        saveButton.addEventListener('click', function () {
            const mangaId = saveButton.dataset.mangaId; // Obtén el ID del manga
            const mangaTitle = saveButton.dataset.mangaTitle; // Obtén el título del manga
            const csrfMetaTag = document.querySelector('meta[name="csrf-token"]');

            if (!csrfMetaTag) {
                console.error('Meta tag for CSRF token not found.');
                return; // Salir si no se encuentra el token
            }

            fetch('/save-manga', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfMetaTag.content
                },
                body: JSON.stringify({
                    url: mangaId,
                    manga_title: mangaTitle,
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Manga guardado con éxito.');
                } else {
                    alert('No se pudo guardar el manga.');
                }
            })
            .catch(error => {
                console.error('Error al guardar el manga:', error);
            });
        });
    }
});



