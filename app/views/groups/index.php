<?php
require_once BASE_PATH . "app/views/layout/header.php";
require_once BASE_PATH . "app/views/layout/navbar.php";
?>
<div class="container mt-4">
    <h2>Lista de Grupos</h2>
    <a href="index.php?view=groupform" class="btn btn-primary mb-3">Agregar Grupo</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="groupTable">
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
                    <form id="groupForm">
                        <input type="hidden" name="id" id="groupId">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        loadGroups();


        window.editGroup = function (id, nombre, descripcion) {
            $('#groupId').val(id);
            $('#nombre').val(nombre);
            $('#descripcion').val(descripcion);
            $('#exampleModal').modal('show');
        };

        $('#groupForm').submit(function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append("action", "store");

            $.ajax({
                url: "app/api.php?action=updateGroup",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {

                    if (response.status === "success") {
                        loadGroups();
                        $('#exampleModal').modal('hide');
                    } else {
                        $('#error-message').html('<div class="alert alert-danger">' + response.message + '</div>');

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

        window.deleteGroup = function (id) {
            if (confirm('¿Estás seguro de eliminar este grupo?')) {
                $.ajax({
                    url: 'app/api.php?action=deleteGroup&id=' + id,
                    method: 'DELETE',
                    success: function () {
                        alert('Grupo eliminado');
                        loadGroups();
                    }
                });
            }
        };


        function loadGroups() {
            $.ajax({
                url: 'app/api.php?action=getGroups', // Corregido para apuntar a api.php
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    let rows = '';
                    response.forEach(group => {
                        rows += `
                        <tr>
                            <td>${group.id}</td>
                            <td>${group.nombre}</td>
                            <td>${group.descripcion}</td>
                            <td>
                               <button class="btn btn-warning btn-sm" 
                                onclick="editGroup(${group.id}, '${group.nombre}', '${group.descripcion}')">Editar</button>
                                <button class="btn btn-danger btn-sm"  onclick="deleteGroup(${group.id})">Eliminar</button>
                            </td>
                        </tr>
                    `;
                    });
                    $('#groupTable').html(rows);
                }
            });
        }

    });




</script>

<?php include BASE_PATH . "app/views/layout/footer.php"; ?>