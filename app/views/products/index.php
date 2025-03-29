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
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="productTable">
            <!-- Se llenará con AJAX -->
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    loadProducts();

    function loadProducts() {
        $.ajax({
            url: 'app/api.php?action=getProducts', // Corregido para apuntar a api.php
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                let rows = '';
                response.forEach(product => {
                    rows += `
                        <tr>
                            <td>${product.id}</td>
                            <td>${product.nombre}</td>
                            <td>${product.precio}</td>
                            <td>${product.stock}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-product" data-id="${product.id}">Editar</button>
                                <button class="btn btn-danger btn-sm delete-product" data-id="${product.id}">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                $('#productTable').html(rows);
            },
            error: function() {
                alert("Error al cargar los productos.");
            }
        });
    }
});
</script>
