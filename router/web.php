<?php
$routes = [
    'home' => 'home.php',
    'products' => 'products/index.php',
    'groups' => 'groups/index.php',
    'assign' => 'product_group/assign.php',
    'productform' => 'products/form.php',
    'groupform' => 'groups/form.php',

];
$view = isset($_GET['view']) ? $_GET['view'] : 'home';
if (!array_key_exists($view, $routes)) {
    $view = '';
}
// Devolver la ruta completa del archivo
return __DIR__ . "/../views/" . $routes[$view];
