document.addEventListener('DOMContentLoaded', function () {
    const saveButton = document.querySelector('#saveMangaButton');

    if (saveButton) {
        saveButton.addEventListener('click', function () {
            const mangaId = saveButton.dataset.mangaId; // Usa data attribute para obtener el ID
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
                body: JSON.stringify({ manga_id: mangaId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Manga guardado con éxito.');
                }
            });
        });
    }
});
