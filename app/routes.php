<?php



// Definir un array de rutas disponibles y su vista asociada
$routes = [
    'home' => 'home.php',
    'products' => 'products/index.php',
    'groups' => 'groups/index.php',
    'assign' => 'product_group/assign.php',
    'productform' => 'products/form.php',
    'groupform' => 'groups/form.php',

];

// Obtener la ruta desde la URL y sanitizar
$view = isset($_GET['view']) ? $_GET['view'] : 'home';

// Validar que la ruta exista, si no, mostrar error 404
if (!array_key_exists($view, $routes)) {
    $view = '404.php'; // Página de error personalizada
}



// Devolver la ruta completa del archivo
return __DIR__ . "/views/" . $routes[$view];
