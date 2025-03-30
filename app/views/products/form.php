<?php
require_once BASE_PATH . "app/views/layout/header.php";
require_once BASE_PATH . "app/views/layout/navbar.php";

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

<script>
    $(document).ready(function () {
        $('#productForm').submit(function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append("action", "store"); // Asegura que 'action' se envíe

            $.ajax({
                url: "app/api.php?action=addProduct",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    data = JSON.parse(response);
                    if (data.status === "success") {
                        window.location.href = 'index.php?view=products';
                    } else {
                        $('#error-message').html('<div class="alert alert-danger">' + data.message + '</div>');

                        setTimeout(function () {
                            $('#error-message').fadeOut('slow', function () {
                                $(this).html('').show();
                            });
                        }, 5000);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error en AJAX:", xhr.responseText);
                    alert('Error en la solicitud AJAX');
                }
            });

        });
    });
</script>

<?php include BASE_PATH . "app/views/layout/footer.php";
?>