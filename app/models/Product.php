<?php
require_once 'Model.php';

class Product extends Model {
    protected $table = 'productos';

    // Insertar un nuevo producto
    public function create($data) {
        $sql = "INSERT INTO {$this->table} (nombre, descripcion, precio, stock, fecha_creacion) 
                VALUES (:nombre, :descripcion, :precio, :stock, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre' => $data['nombre'],
            ':descripcion' => $data['descripcion'],
            ':precio' => $data['precio'],
            ':stock' => $data['stock']
        ]);
    }

    // Actualizar un producto
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET nombre = :nombre, descripcion = :descripcion, 
                precio = :precio, stock = :stock WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nombre' => $data['nombre'],
            ':descripcion' => $data['descripcion'],
            ':precio' => $data['precio'],
            ':stock' => $data['stock']
        ]);
    }
}
