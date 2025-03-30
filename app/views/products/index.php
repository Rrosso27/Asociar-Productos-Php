<?php
require_once BASE_PATH . "app/views/layout/header.php";
require_once BASE_PATH . "app/views/layout/navbar.php";

?>

<div class="container mt-4">
    <h2>Lista de Productos</h2>
    <a href="index.php?view=productform" class="btn btn-primary mb-3">Agregar Producto</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>descripcion</th>
                <th>Stock</th>
                <th>Acciones</th>

            </tr>
        </thead>
        <tbody id="productTable">
            <!-- Se llenará con AJAX -->
        </tbody>
    </table>
</div>

<div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        <input type="hidden" id="productId" name="id">
                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre">
                        </div>
                        <div>
                            <label>Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Precio</label>
                            <input type="number" name="precio" class="form-control" id="precio">
                        </div>
                        <div class="mb-3">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control" id="stock">
                        </div>
                        <div id="error-message"></div>
                        <div id="success-message"></div>

                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        loadProducts();

        function loadProducts() {
            $.ajax({
                url: 'app/api.php?action=getProducts', // Corregido para apuntar a api.php
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
                url: "app/api.php?action=updateProduct",
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
                    url: 'app/api.php?action=deleteProduct&id=' + id,
                    method: 'DELETE',
                    success: function () {
                        alert('producto eliminado');
                        loadProducts();
                    }
                });
            }
        };



    });



</script>