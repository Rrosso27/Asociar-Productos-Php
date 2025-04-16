<?php
require_once __DIR__ . '/../messages/MessageHandler.php';
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
            return MessageHandler::get('product_no_found');
        }
        return true;
    }

    public function productExistsByID($productId)
    {
        $group = new Group();
        $result = $group->getById($productId);
        if ($result) {
            return MessageHandler::get('product_exists_grup');
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
            return MessageHandler::get('group_no_found');
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
            return MessageHandler::get('Group_id_required');
        }
        if (!is_numeric($groupId)) {
            return MessageHandler::get('Group_id_invalid');
        }

        if (!filter_var($groupId, FILTER_VALIDATE_FLOAT)) {
            return MessageHandler::get('Group_id_invalid');
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
            return MessageHandler::get('Product_id_required');
        }
        if (!is_numeric($productId)) {
            return MessageHandler::get('Product_id_invalid');
        }

        if (!filter_var($productId, FILTER_VALIDATE_FLOAT)) {
            return MessageHandler::get('Product_id_invalid');
        }
        return true;
    }
}