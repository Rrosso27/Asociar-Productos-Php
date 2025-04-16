<?php
require_once BASE_PATH . "views/layout/header.php";
require_once BASE_PATH . "views/layout/navbar.php";
?>
<div class="container mt-4">
    <h2>Asignar Productos a Grupos</h2>
    <div id="alert"></div>
    <div class="row">
        <!-- Selección de Grupo -->
        <div class="col-md-6">
            <label for="selectVal">Selecciona un Grupo:</label>
            <select id="selectVal" class=" form-select selectVal">
                <option value="">Seleccionar...</option>
                <!-- Se llenará con AJAX -->
            </select>
        </div>
        <!-- Selección de Producto -->
        <div class="col-md-6">
            <label for="productoSelect">Selecciona un Producto:</label>
            <select id="productoSelect" class="form-select">
                <option value="">Seleccionar...</option>
                <!-- Se llenará con AJAX -->
            </select>
        </div>
    </div>
    <button class="btn btn-primary mt-3" onclick="asignarProducto()">Asignar Producto</button>
    <div class="col-md-6">
        <label for="grupoSelect">Filrar Grupos</label>
        <select id="grupoSelect" class="form-select selectVal">
            <option value="">Seleccionar...</option>
            <!-- Se llenará con AJAX -->
        </select>
    </div>
    <h3 class="mt-4">Productos Asignados</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre Producto</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody id="asignacionesTable">
            <!-- Se llenará con AJAX -->
        </tbody>
    </table>
</div>
<script src="<?= BASE_URL ?>public/js/product_group/assign.js"></script>
<?php include BASE_PATH . "views/layout/footer.php"; ?>