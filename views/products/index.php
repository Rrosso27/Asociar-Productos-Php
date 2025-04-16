<?php
require_once BASE_PATH . "views/layout/header.php";
require_once BASE_PATH . "views/layout/navbar.php";
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

<script src="<?= BASE_URL ?>public/js/products/index.js"></script>
<?php include BASE_PATH . "views/layout/footer.php"; ?>