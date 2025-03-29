<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/GroupController.php';

$controller = null;
$response = ['status' => 'error', 'message' => 'Acción no válida'];

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getProducts':
            $controller = new ProductController();
            $response = $controller->index();
            break;

        case 'addProduct':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new ProductController();
                $response = $controller->addProduct($_POST);
            } else {
                $response = ['status' => 'error', 'message' => 'Método no permitido'];
            }
            break;

        case 'getGroups':
            $controller = new GroupController();
            $response = $controller->index();
            break;

        case 'addGroup':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new GroupController();
                $response = $controller->addGroup();
            } else {
                $response = ['status' => 'error', 'message' => 'Método no permitido'];
            }
            break;

        default:
            $response = ['status' => 'error', 'message' => 'Ruta no encontrada'];
            break;
    }
}

echo json_encode($response);
