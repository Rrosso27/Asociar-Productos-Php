$(document).ready(function () {
    cargarGrupos();
    cargarProductos();
    cargarProductosAsignados();
    $('#grupoSelect').change(function () {
        cargarProductosAsignados($(this).val());
    });
    function cargarGrupos() {
        $.ajax({
            url: 'router/api.php?action=getGroups',
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
            url: 'router/api.php?action=getProducts',
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
                url: 'router/api.php?action=getAsignGroupById&grupoId=' + grupoId,
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
            url: 'router/api.php?action=asignGroup',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ grupo_id: grupoId, producto_id: productoId }),
            success: function (response) {
                if (response.status === 'success') {
                    $('#alert').html(`<div class="alert alert-success">${response.message}</div>`);
                    cargarProductosAsignados(grupoId);
                } else {
                    $('#alert').html(`<div class="alert alert-danger">${response.message}</div>`);
                }
                cargarProductosAsignados(grupoId);
            }
        });
    };
    window.removerAsignacion = function (productoId, grupoId) {
        if (confirm("¿Estás seguro de remover este producto del grupo?")) {
            $.ajax({
                url: 'router/api.php?action=removeAsignGroup',
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