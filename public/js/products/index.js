$(document).ready(function () {
    loadProducts();
    function loadProducts() {
        $.ajax({
            url: 'router/api.php?action=getProducts', 
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                let rows = '';
                response.forEach(product => {
                    rows += `
                    <tr>
                        <td>${product.id}</td>
                        <td>${product.nombre}</td>
                        <td>${product.precio}</td>
                        <td>${product.descripcion}</td>

                        <td>${product.stock}</td>
                        <td>
                            <button  data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-warning btn-sm edit-product"  onclick="updateList(${product.id}, '${product.nombre}', ${product.precio}, ${product.stock}, '${product.descripcion}')" >Editar</button>
                            <button class="btn btn-danger btn-sm delete-product" onclick="deleteProduct(${product.id})" >Eliminar</button>
                        </td>
                    </tr>
                `;
                });
                $('#productTable').html(rows);
            },
            error: function () {
                alert("Error al cargar los productos.");
            }
        });
    }
    window.updateList = function (id, nombre, precio, stock, descripcion) {
        $('#productId').val(id);
        $('#nombre').val(nombre);
        $('#precio').val(precio);
        $('#stock').val(stock);
        $('#descripcion').val(descripcion);

    };
    $('#productForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append("action", "updateProduct");
        $.ajax({
            url: "router/api.php?action=updateProduct",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    loadProducts();
                    $('#success-message').html('<div class="alert alert-success">' + response.message + '</div>');
                } else {
                    $('#error-message').html('<div class="alert alert-danger">' + response.message + '</div>');

                    setTimeout(function () {
                        $('#error-message').fadeOut('slow', function () {
                            $(this).html('').show();
                        });
                    }, 5000);
                }
            },
            error: function () {
                alert("Error al actualizar el producto.");
            }
        });
    });
    window.deleteProduct = function (id) {
        if (confirm('¿Estás seguro de eliminar este producto?')) {
            $.ajax({
                url: 'router/api.php?action=deleteProduct&id=' + id,
                method: 'DELETE',
                success: function () {
                    alert('producto eliminado');
                    loadProducts();
                }
            });
        }
    };
});