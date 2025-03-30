<?php
require_once BASE_PATH . "app/views/layout/header.php";
require_once BASE_PATH . "app/views/layout/navbar.php";
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

<script>
    $(document).ready(function () {
        cargarGrupos();
        cargarProductos();
        cargarProductosAsignados();
        $('#grupoSelect').change(function () {
            cargarProductosAsignados($(this).val());
        });

        function cargarGrupos() {
            $.ajax({
                url: 'app/api.php?action=getGroups',
                method: 'GET',
                success: function (response) {
                    response.forEach(grupo => {
                        $('.selectVal').append(`<option value="${grupo.id}">${grupo.nombre}</option>`);
                    });
                }
            });
        }

        function cargarProductos() {
            $.ajax({
                url: 'app/api.php?action=getProducts',
                method: 'GET',
                success: function (response) {
                    response.forEach(producto => {
                        $('#productoSelect').append(`<option value="${producto.id}">${producto.nombre}</option>`);
                    });
                }
            });
        }

        function cargarProductosAsignados(grupoId) {
            if (!grupoId) {
                $('#asignacionesTable').append(`<tr><td colspan="3">Selecciona un grupo para ver los productos asignados.</td></tr>`);
                return;
            } else {
                $.ajax({
                    url: 'app/api.php?action=getAsignGroupById&grupoId=' + grupoId,
                    method: 'GET',
                    success: function (response) {
                        $('#asignacionesTable').empty();
                        response.forEach(producto => {
                            $('#asignacionesTable').append(`
                        <tr>
                            <td>${producto.producto_id}</td>
                            <td>${producto.nombre}</td>
                            <td><button class="btn btn-danger" onclick="removerAsignacion(${producto.producto_id}, ${grupoId})">Remover</button></td>
                        </tr>
                    `);
                        });
                    }
                });
            }

        }


        window.asignarProducto = function () {
            let grupoId = $('#selectVal').val();
            let productoId = $('#productoSelect').val();

            if (!grupoId || !productoId) {
                alert("Selecciona un grupo y un producto.");
                return;
            }

            $.ajax({
                url: 'app/api.php?action=asignGroup',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ grupo_id: grupoId, producto_id: productoId }),
                success: function (response) {
                    if (response.status === 'success') {
                        $('#alert').html(`<div class="alert alert-success">${response.message}</div>`);
                        cargarProductosAsignados(grupoId);
                    }else {
                        $('#alert').html(`<div class="alert alert-danger">${response.message}</div>`);
                    }
                    cargarProductosAsignados(grupoId);
                }
            });
        };

        window.removerAsignacion = function (productoId, grupoId) {
            if (confirm("¿Estás seguro de remover este producto del grupo?")) {
                $.ajax({
                    url: 'app/api.php?action=removeAsignGroup',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ grupo_id: grupoId, producto_id: productoId }),
                    success: function () {
                        alert("Producto removido correctamente.");
                        cargarProductosAsignados(grupoId);
                    }
                });
            }
        };
    });
</script>

<?php include BASE_PATH . "app/views/layout/footer.php"; ?>