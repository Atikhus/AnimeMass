document.addEventListener('DOMContentLoaded', function () {
    // Realiza una solicitud fetch a la ruta de listaFavoritos
    fetch('/lista-favoritos')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Asumiendo que retornas JSON
        })
        .then(data => {
            console.log(data); // Aquí tendrás los datos de $userLinks
            const listContainer = document.querySelector('#user-links-list');
            listContainer.innerHTML = ''; // Limpiar contenido previo
            if (data.length === 0) {
                listContainer.innerHTML = '<li>No tienes mangas favoritos.</li>';
            } else {
                data.forEach(link => {
                    const listItem = document.createElement('li');
                    const linkElement = document.createElement('a'); // Crear un nuevo enlace
                    
                    // Concatenar la URL base con el ID del manga
                    const baseUrl = 'http://127.0.0.1:8000/manga/';
                    linkElement.href = baseUrl + link.url; // Construir la URL completa
                    linkElement.textContent = link.url; // Mostrar la URL como texto
                    linkElement.setAttribute('data-id', link.url); // Agregar el ID como atributo de datos
                    
                    listItem.appendChild(linkElement); // Añadir el enlace al elemento de la lista
                    listContainer.appendChild(listItem); // Añadir el elemento de la lista al contenedor
                });
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
});
