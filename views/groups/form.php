<?php
require_once BASE_PATH . "views/layout/header.php";
require_once BASE_PATH . "views/layout/navbar.php";
?>
<div class="container mt-4">

    <h2 id="formTitle">Agregar Grupo</h2>
    <div id="error-message"></div>

    <form id="groupForm">
        <input type="hidden" id="groupId">
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre">
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
<script src="<?= BASE_URL ?>public/js/groups/form.js"></script>
<?php include BASE_PATH . "views/layout/footer.php"; ?>