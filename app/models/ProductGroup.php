<?php
require_once 'Model.php';


class ProductGroup extends Model
{
    protected $table = 'producto_grupo';
    // Asignar un producto a un grupo
    public function assignProductToGroup($productId, $groupId)
    {
        $sql = "INSERT INTO {$this->table} (producto_id, grupo_id) VALUES (:producto_id, :grupo_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':producto_id' => $productId,
            ':grupo_id' => $groupId
        ]);
    }

    // Remover un producto de un grupo
    public function removeProductFromGroup($productId, $groupId)
    {
        $sql = "DELETE FROM {$this->table} WHERE producto_id = :producto_id AND grupo_id = :grupo_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':producto_id' => $productId,
            ':grupo_id' => $groupId
        ]);
    }
     // Validar si un producto ya está asignado a un grupo
    function validateExistence($productId, $groupId)
    {

        $sql = "SELECT 1 FROM {$this->table} WHERE producto_id = :producto_id AND grupo_id = :grupo_id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':producto_id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':grupo_id', $groupId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) !== false; // Retorna true si ya existe
    }

    // Obtener los grupos a los que pertenece un producto
    public function getGroupsByProduct($id)
    {
        $data = $id;
        $sql = "SELECT pg.*, ps.nombre FROM producto_grupo as pg INNER JOIN grupos gp ON pg.grupo_id = gp.id INNER JOIN productos ps ON pg.producto_id = ps.id WHERE pg.grupo_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

