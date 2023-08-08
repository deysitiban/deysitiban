

document.addEventListener('DOMContentLoaded', function() {
    // Agrega el evento onclick al enlace "Desparacitantes Externos"
    document.getElementById('desparacitantes_externos_link').addEventListener('click', function(event) {
        event.preventDefault(); // Evita que el enlace realice la acción predeterminada (no se recargará la página)

        // Realiza la solicitud AJAX para cargar Pdesexterno.php
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'Pdesexterno.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Si la solicitud se completó correctamente, coloca el contenido en el main
                    main_content.innerHTML = xhr.responseText;
                } else {
                    // Si ocurrió un error, muestra un mensaje en la consola
                    console.error('Error al cargar el contenido.');
                }
            }
        };
        xhr.send();
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Agrega el evento onclick al enlace "Desparacitantes Internos"
    document.getElementById('desparacitantes_internos_link').addEventListener('click', function(event) {
        event.preventDefault(); // Evita que el enlace realice la acción predeterminada (no se recargará la página)

        // Realiza la solicitud AJAX para cargar DEinteperros.php
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'DEinteperros.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Si la solicitud se completó correctamente, coloca el contenido en el main
                    main_content.innerHTML = xhr.responseText;
                } else {
                    // Si ocurrió un error, muestra un mensaje en la consola
                    console.error('Error al cargar el contenido.');
                }
            }
        };
        xhr.send();
    });
});
