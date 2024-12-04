// Código para el carrito de compras
$(document).ready(function () {
    let carrito = []; // Array para almacenar los productos del carrito

    // Actualizar el contador del carrito
    function actualizarContador() {
        const contador = $('#contadorCarrito');
        contador.text(carrito.length);
        if (carrito.length > 0) {
            contador.show();
        } else {
            contador.hide();
        }
    }

    // Evento para agregar productos al carrito
    $(document).on('click', '.Button', function () {
        const producto = $(this).closest('.producto'); // Obtiene el contenedor del producto
        const nombre = producto.find('h3').text(); // Obtiene el nombre del producto
        const descripcion = producto.find('p').text(); // Obtiene la descripción
        const imagen = producto.find('img').attr('src'); // Obtiene la URL de la imagen

        // Crea un objeto de producto
        const item = {
            nombre,
            descripcion,
            imagen
        };

        // Agrega el producto al carrito
        carrito.push(item);
        alert(`${nombre} ha sido agregado al carrito.`);
        actualizarContador();
    });

    // Evento para mostrar los productos del carrito al hacer clic en la imagen del carrito
    $('#compras').click(function () {
        if (carrito.length === 0) {
            alert('El carrito está vacío.');
            return;
        }

        // Genera el contenido del carrito
        let carritoHTML = '<h2>Carrito de Compras</h2><ul style="list-style: none; padding: 0;">';
        carrito.forEach(function (item, index) {
            carritoHTML += `
                <li style="margin-bottom: 15px; display: flex; align-items: center;">
                    <img src="${item.imagen}" alt="${item.nombre}" width="50" style="margin-right: 10px;">
                    <div style="flex-grow: 1;">
                        <strong>${item.nombre}</strong><br>
                        <span>${item.descripcion}</span>
                    </div>
                    <button class="eliminar" data-index="${index}" style="background: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">Eliminar</button>
                </li>`;
        });
        carritoHTML += '</ul><button id="comprarProductos" style="background: green; color: white; border: none; padding: 10px 10px; cursor: pointer;">Comprar</button>';
    
        // Muestra el contenido del carrito en un modal o en un área específica
        const modal = $('<div id="modalCarrito" class="modal" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.5); z-index: 1000; border-radius: 10px; width: 300px; max-height: 400px; overflow-y: auto;"></div>');
        modal.html(`${carritoHTML}<button id="cerrarCarrito" style="margin-top: 20px; background: red; color: white; border: none; padding: 10px 10px; cursor: pointer;">Cerrar</button>`);
        $('body').append(modal);

        // Evento para cerrar el modal
        $('#cerrarCarrito').click(function () {
            $('#modalCarrito').remove();
        });

        // Evento para eliminar productos del carrito
        $('.eliminar').click(function () {
            const index = $(this).data('index');
            carrito.splice(index, 1); // Elimina el producto del array
            $(this).closest('li').remove(); // Elimina el producto del DOM

            actualizarContador();

            // Si el carrito queda vacío, elimina el modal
            if (carrito.length === 0) {
                alert('El carrito está ahora vacío.');
                $('#modalCarrito').remove();
            }
        });

        // Evento para finalizar la compra
        $('#comprarProductos').click(function () {
            alert('Gracias por su compra.');
            carrito = []; // Vacía el carrito
            actualizarContador();
            $('#modalCarrito').remove(); // Cierra el modal
        });
    });

    // Añadir un contador de productos al carrito
    $('body').append('<span id="contadorCarrito" style="display: none; position: absolute; top: 10px; right: 10px; background: red; color: white; border-radius: 50%; padding: 5px 10px; font-size: 14px;"></span>');
});



