<?php
require_once BASE_PATH . "app/views/layout/header.php";
require_once BASE_PATH . "app/views/layout/navbar.php";
?>
<div class="container mt-4">
    <h2 id="formTitle">Agregar Grupo</h2>
    <form id="groupForm">
        <input type="hidden" id="groupId">
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" class="form-control" id="nombre">
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea class="form-control" id="descripcion"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#groupForm').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serialize() + "&action=store";
        
        $.ajax({
            url: "",
            type: "POST",
            data: formData,
            contentType: 'application/json',
            data: JSON.stringify({
                nombre: $('#nombre').val(),
                descripcion: $('#descripcion').val()
            }),
            success: function() {
                alert('Grupo guardado');
                window.location.href = 'index.php';
            }
        });
    });
});
</script>

<?php include BASE_PATH . "app/views/layout/footer.php"; ?>


