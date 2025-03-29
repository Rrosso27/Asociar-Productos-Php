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

<script>
    $(document).ready(function () {
        loadGroups();

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
                                <button class="btn btn-warning btn-sm" onclick="editGroup(${group.id})">Editar</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteGroup(${group.id})">Eliminar</button>
                            </td>
                        </tr>
                    `;
                    });
                    $('#groupTable').html(rows);
                }
            });
        }

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
    });
</script>

<?php include BASE_PATH . "app/views/layout/footer.php"; ?>