<?php include 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>

<div class="container mt-4">
    <h1 class="text-center">Gestión de Productos y Grupos</h1>

    <div class="row mt-4">
        <!-- Resumen de Productos -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Productos</div>
                <div class="card-body">
                    <h5 class="card-title" id="totalProductos">0</h5>
                    <p class="card-text">Productos registrados en el sistema.</p>
                    <a href="index.php?view=products" class="btn btn-light">Ver Productos</a>
                </div>
            </div>
        </div>

        <!-- Resumen de Grupos -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Grupos</div>
                <div class="card-body">
                    <h5 class="card-title" id="totalGrupos">0</h5>
                    <p class="card-text">Grupos disponibles para asignaciones.</p>
                    <a  href="index.php?view=groups" class="btn btn-light">Ver Grupos</a>
                </div>
            </div>
        </div>
        
        <!-- Resumen de Asignaciones -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Asignaciones</div>
                <div class="card-body">
                    <h5 class="card-title" id="totalAsignaciones">0</h5>
                    <p class="card-text">Productos asignados a grupos.</p>
                    <a href="index.php?view=assign" class="btn btn-light">Gestionar Asignaciones</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Cargar estadísticas generales con AJAX
    $.ajax({
        url: 'public/index.php?controller=dashboard&action=stats',
        method: 'GET',
        success: function(response) {
            $('#totalProductos').text(response.totalProductos);
            $('#totalGrupos').text(response.totalGrupos);
            $('#totalAsignaciones').text(response.totalAsignaciones);
        }
    });
});
</script>

<?php include 'layout/footer.php'; ?>
