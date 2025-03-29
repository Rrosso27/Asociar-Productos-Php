<?php
require_once BASE_PATH . "app/views/layout/header.php";
require_once BASE_PATH . "app/views/layout/navbar.php";
?>

<div class="container mt-4">
    <h2>Asignar Productos a Grupos</h2>

    <div class="row">
        <!-- Selección de Grupo -->
        <div class="col-md-6">
            <label for="grupoSelect">Selecciona un Grupo:</label>
            <select id="grupoSelect" class="form-select">
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
$(document).ready(function() {
    cargarGrupos();
    cargarProductos();

    $('#grupoSelect').change(function() {
        cargarProductosAsignados($(this).val());
    });

    function cargarGrupos() {
        $.ajax({
            url: '../../public/index.php?controller=group&action=index',
            method: 'GET',
            success: function(response) {
                response.forEach(grupo => {
                    $('#grupoSelect').append(`<option value="${grupo.id}">${grupo.nombre}</option>`);
                });
            }
        });
    }

    function cargarProductos() {
        $.ajax({
            url: '../../public/index.php?controller=product&action=index',
            method: 'GET',
            success: function(response) {
                response.forEach(producto => {
                    $('#productoSelect').append(`<option value="${producto.id}">${producto.nombre}</option>`);
                });
            }
        });
    }

    function cargarProductosAsignados(grupoId) {
        if (!grupoId) return;
        
        $.ajax({
            url: '../../public/index.php?controller=productGroup&action=list&grupo_id=' + grupoId,
            method: 'GET',
            success: function(response) {
                let rows = '';
                response.forEach(asignacion => {
                    rows += `
                        <tr>
                            <td>${asignacion.producto_id}</td>
                            <td>${asignacion.nombre_producto}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="removerAsignacion(${asignacion.producto_id}, ${grupoId})">Remover</button>
                            </td>
                        </tr>
                    `;
                });
                $('#asignacionesTable').html(rows);
            }
        });
    }

    window.asignarProducto = function() {
        let grupoId = $('#grupoSelect').val();
        let productoId = $('#productoSelect').val();

        if (!grupoId || !productoId) {
            alert("Selecciona un grupo y un producto.");
            return;
        }

        $.ajax({
            url: '../../public/index.php?controller=productGroup&action=assign',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ grupo_id: grupoId, producto_id: productoId }),
            success: function() {
                alert("Producto asignado correctamente.");
                cargarProductosAsignados(grupoId);
            }
        });
    };

    window.removerAsignacion = function(productoId, grupoId) {
        if (confirm("¿Estás seguro de remover este producto del grupo?")) {
            $.ajax({
                url: '../../public/index.php?controller=productGroup&action=remove',
                method: 'DELETE',
                contentType: 'application/json',
                data: JSON.stringify({ grupo_id: grupoId, producto_id: productoId }),
                success: function() {
                    alert("Producto removido correctamente.");
                    cargarProductosAsignados(grupoId);
                }
            });
        }
    };
});
</script>

<?php include BASE_PATH . "app/views/layout/footer.php"; ?>

