<?php
define('BASE_PATH', dirname(__DIR__, 2) . '/');
define('BASE_URL', '/Asociar-Productos-Php/');

require_once 'env.php';

define('DB_HOST', 'db'); // Nombre del servicio definido en docker-compose.yml
define('DB_NAME', 'asociar_productos');
define('DB_USER', 'user');
define('DB_PASSWORD', 'password');

define('DEBUG_MODE', true); // Cambiar a false en producción

// Configurar el registro de errores
ini_set('log_errors', 1);
ini_set('error_log', BASE_PATH . '/logs/php_errors.log');

if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
}

// Cargar automáticamente las clases de los modelos y controladores
spl_autoload_register(function ($class) {
    $paths = [
        BASE_PATH . '/app/models/' . $class . '.php',
        BASE_PATH . '/app/controllers/' . $class . '.php'
    ];
    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            break;
        }
    }
});