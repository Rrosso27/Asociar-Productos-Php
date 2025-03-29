<?php
class CreateGroupsTable {
    public function up($conn) {
        $sql = "CREATE TABLE IF NOT EXISTS grupos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            descripcion TEXT
        )";
        $conn->exec($sql);
    }

    public function down($conn) {
        $sql = "DROP TABLE IF EXISTS grupos";
        $conn->exec($sql);
    }
}

