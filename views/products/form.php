<?php
require_once BASE_PATH . "views/layout/header.php";
require_once BASE_PATH . "views/layout/navbar.php";
?>
<div class="container mt-4">
    <div id="error-message"></div>
    <h2 id="formTitle">Agregar Producto</h2>
    <form id="productForm">
        <input type="hidden" id="productId">
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
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
<script src="<?= BASE_URL ?>public/js/products/form.js"></script>
<?php include BASE_PATH . "views/layout/footer.php";
?>