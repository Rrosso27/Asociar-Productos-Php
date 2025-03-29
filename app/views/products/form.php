<?php
require_once BASE_PATH . "app/views/layout/header.php";
require_once BASE_PATH . "app/views/layout/navbar.php";

?>

<div class="container mt-4">
    <h2 id="formTitle">Agregar Producto</h2>
    <form id="productForm">
        <input type="hidden" id="productId">
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" class="form-control" id="nombre">
        </div>
        <div class="mb-3">
            <label>Precio</label>
            <input type="number" class="form-control" id="precio">
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input type="number" class="form-control" id="stock">
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#productForm').submit(function(e) {
        e.preventDefault();
  

        $.ajax({
            url: 'http://localhost/proyecto/api.php?action=addProduct',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                nombre: $('#nombre').val(),
                precio: $('#precio').val(),
                stock: $('#stock').val()
            }),
            success: function() {
                alert('Producto guardado');
                window.location.href = 'index.php';
            }
        });
    });
});
</script>

<?php include BASE_PATH . "app/views/layout/footer.php";
 ?>


