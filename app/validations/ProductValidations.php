<?php

require_once __DIR__ . '/../messages/MessageHandler.php';

class ProductValidations
{
    /**
     * verificar si el producto existe por nombre
     * @param mixed $name
     * @return bool|string
     */
    public function productsExistName($name)
    {
        $Product = new Product();
        $result = $Product->productsExistName($name);
        if ($result) {
            return "el producto ya existe.";
        }
        return true;
    }
    /**
     * verificar si el producto existe por nombre
     * @param mixed $name
     * @return bool|string
     */
    public function validateProductName($name)
        {
            $name = trim($name);
        if (empty($name)) {
            return MessageHandler::get('Form_name_required');
        }
        if (strlen($name) < 3) {
            return MessageHandler::get('Form_name_min_length');
        }
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
            return MessageHandler::get('Form_name_invalid');
        }
        return true;
    }
    /**
     * validar precio
     * @param mixed $price
     * @return bool|string
     */
    public function validateProductPrice($price)
    {
        $price = trim($price);
        if (!filter_var($price, FILTER_VALIDATE_FLOAT)) {
            return MessageHandler::get('Product_price_invalid');
        }
        if ($price <= 0) {
            return MessageHandler::get('Product_price_required');
        }
        return true;
    }
    /**
     * Validar Descripción
     * @param mixed $description
     * @return bool|string
     */
    public function validateProductDescription($description)
    {
        $description = trim($description);
        if (empty($description)) {
            return MessageHandler::get('Form_description_required');
        }
        if (strlen($description) < 3) {
            return MessageHandler::get('Form_description_min_length');
        }
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $description)) {
            return MessageHandler::get('Form_description_invalid');
        }
        return true;
    }
    /**
     * Validar Stock
     * @param mixed $stock
     * @return bool|string
     */
    public function validateProductCStock($stock)
    {
        $stock = trim($stock);
        if (!filter_var($stock, FILTER_VALIDATE_FLOAT)) {
            return MessageHandler::get('Product_stock_invalid');
        }
        if ($stock <= 0) {
            return MessageHandler::get('Product_stock');
        }
        return true;
    }
}