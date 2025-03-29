<?php
// Incluir configuración
require_once 'app/config/config.php';

// Obtener la vista correspondiente desde `routes.php`
$viewFile = require_once 'app/routes.php';

// Incluir encabezado
require_once 'app/views/layout/header.php';

// Incluir la vista seleccionada
require_once $viewFile;

// Incluir pie de página
require_once 'app/views/layout/footer.php';

