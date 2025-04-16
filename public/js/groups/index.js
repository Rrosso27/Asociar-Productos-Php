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
            url: "router/api.php?action=updateGroup",
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
                url: 'router/api.php?action=deleteGroup&id=' + id,
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
            url: 'router/api.php?action=getGroups',
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