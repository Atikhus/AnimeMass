document.addEventListener('DOMContentLoaded', function () {
    fetch('/lista-favoritos')
        .then(response => response.json())
        .then(data => {
            const listContainer = document.querySelector('#user-s-list'); // Asegúrate de usar el ID correcto
            listContainer.innerHTML = ''; // Limpiar contenido previo

            if (data.length === 0) {
                listContainer.innerHTML = '<li>No tienes mangas favoritos.</li>';
            } else {
                data.forEach(link => {
                    const listItem = document.createElement('li');
                    listItem.classList.add('manga-item'); // Clase para estilizar el contenedor
                
                    // Crear un contenedor para el contenido
                    const boxContainer = document.createElement('div');
                    boxContainer.classList.add('manga-box'); // Clase para la caja
                
                    // Configura el título
                    const titleElement = document.createElement('span');
                    titleElement.textContent = link.title;
                
                    // Configura el enlace
                    const baseUrl = 'http://127.0.0.1:8000/manga/';
                    const linkElement = document.createElement('a');
                    linkElement.href = baseUrl + link.url;
                    linkElement.textContent = "Leer";
                    
                    // Configura el botón de eliminar
                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Eliminar de mi lista';
                    deleteButton.classList.add('delete-button');
                    deleteButton.setAttribute('data-id', link.id);
                
                    // Añadir elementos al boxContainer
                    boxContainer.appendChild(titleElement);
                    boxContainer.appendChild(linkElement);
                    boxContainer.appendChild(deleteButton);
                    
                    // Añadir el boxContainer al listItem
                    listItem.appendChild(boxContainer);
                    listContainer.appendChild(listItem); // Añadir listItem al contenedor
                });
                
            }

            // Manejador de eventos para los botones de eliminar
            listContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('delete-button')) {
                    const mangaId = event.target.getAttribute('data-id'); // Obtenemos el id del manga
                    
                    // Verifica el token CSRF
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');
                    if (csrfToken) {
                        // Realizamos una solicitud fetch para eliminar el manga
                        fetch(`/eliminar-manga/${mangaId}`, {
                            method: 'DELETE', // Usamos DELETE para eliminar
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken.getAttribute('content') // Token CSRF para seguridad
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                event.target.closest('li').remove(); // Removemos el elemento de la lista
                                console.log('Manga eliminado de favoritos');
                            } else {
                                console.error('Error al eliminar el manga');
                            }
                        })
                        .catch(error => console.error('Hubo un error en la solicitud:', error));
                    } else {
                        console.error('Token CSRF no encontrado');
                    }
                }
            });
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
});
