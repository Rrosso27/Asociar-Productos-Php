<?php
class CreateProductGroupTable {
    public function up($conn) {
        $sql = "CREATE TABLE IF NOT EXISTS producto_grupo (
            producto_id INT NOT NULL,
            grupo_id INT NOT NULL,
            PRIMARY KEY (producto_id, grupo_id),
            FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE,
            FOREIGN KEY (grupo_id) REFERENCES grupos(id) ON DELETE CASCADE
        )";
        $conn->exec($sql);
    }

    public function down($conn) {
        $sql = "DROP TABLE IF EXISTS producto_grupo";
        $conn->exec($sql);
    }
}

