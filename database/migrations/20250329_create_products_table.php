<?php
class CreateProductsTable {
    public function up($conn) {
        $sql = "CREATE TABLE IF NOT EXISTS productos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            descripcion TEXT,
            precio DECIMAL(10,2) NOT NULL,
            stock INT NOT NULL,
            fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            estado TINYINT(1) DEFAULT 1
        )";
        $conn->exec($sql);
    }

    public function down($conn) {
        $sql = "DROP TABLE IF EXISTS productos";
        $conn->exec($sql);
    }
}

