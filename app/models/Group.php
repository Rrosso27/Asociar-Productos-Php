<?php
require_once 'Model.php';

class Group extends Model
{
    protected $table = 'grupos';

    public function productExistsByID($productId)
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE producto_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $productId]);
        return $stmt->fetchColumn() > 0;
    }

    public function groupExistsByName($name)
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE nombre = :nombre";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':nombre' => $name]);
        return $stmt->fetchColumn() > 0;
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (nombre, descripcion) VALUES (:nombre, :descripcion)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre' => $data['nombre'],
            ':descripcion' => $data['descripcion']
        ]);
    }

    public function update($data)
    {
        $sql = "UPDATE {$this->table} SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $data['id'],
            ':nombre' => $data['nombre'],
            ':descripcion' => $data['descripcion']
        ]);
    }
}
