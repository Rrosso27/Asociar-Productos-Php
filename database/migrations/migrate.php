<?php
require_once __DIR__ . '/../db.php';

function runMigrations($conn) {
    $migrationFiles = glob(__DIR__ . '/*.php');

    foreach ($migrationFiles as $file) {
        require_once $file;
        $className = basename($file, '.php');
        if (class_exists($className)) {
            $migration = new $className();
            $migration->up($conn);
            echo "Ejecutada: $className\n";
        }
    }
}

$db = new Database();
$conn = $db->getConnection();
runMigrations($conn);
?>
