<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Group.php';
class ProductGroupValidations
{
    /**
     * Validar producto existe
     * @param mixed $groupId
     * @return bool|string
     */
    public function productExists($productId)
    {
        $product = new Product();
        $result = $product->getById($productId);
        if (!$result) {
            return "Product with ID {$productId} does not exist.";
        }
        return true;
    }
    /**
     * Validar grupo id existe
     * @param mixed $groupId
     * @return bool|string
     */
    public function groupExists($groupId)
    {
        $group = new Group();
        $result = $group->getById($groupId);
        if (!$result) {
            return "Group with ID {$groupId} does not exist.";
        }
        return true;
    }
    /**
     * Validar ID de grupo
     * @param mixed $groupId
     * @return bool|string
     */
    public function validateGroupId($groupId)
    {
        $groupId = trim($groupId);
        if (empty($groupId)) {
            return "Group ID cannot be empty.";
        }
        if (!is_numeric($groupId)) {
            return "Group ID must be a valid number.";
        }

        if (!filter_var($groupId, FILTER_VALIDATE_FLOAT)) {
            return " groupId must be a valid number.";
        }
        return true;
    }
    /**
     * Validar ID de producto
     * @param mixed $productId
     * @return bool|string
     */
    public function validateProductId($productId)
    {
        $productId = trim($productId);
        if (empty($productId)) {
            return "Product ID cannot be empty.";
        }
        if (!is_numeric($productId)) {
            return "Product ID must be a valid number.";
        }

        if (!filter_var($productId, FILTER_VALIDATE_FLOAT)) {
            return " productId must be a valid number.";
        }
        return true;
    }
}