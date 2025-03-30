<?php

class ProductValidations
{

    /**
     * validar nombre
     * @param mixed $name
     * @return bool|string
     */
    public function validateProductName($name)
    {
        $name = trim($name);
        if (empty($name)) {
            return "Product name cannot be empty.";
        }
        if (strlen($name) < 3) {
            return "Product name must be at least 3 characters long.";
        }
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
            return "Product name can only contain letters, numbers, and spaces.";
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
            return "Product price must be a valid number.";
        }
        if ($price <= 0) {
            return "Product price must be greater than zero.";
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
        $name = trim($description);
        if (empty($name)) {
            return "Product description cannot be empty.";
        }
        if (strlen($name) < 3) {
            return "Product description must be at least 3 characters long.";
        }
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $description)) {
            return "Product description can only contain letters, numbers, and spaces.";
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
        $price = trim($stock);
        if (!filter_var($stock, FILTER_VALIDATE_FLOAT)) {
            return "Product stock must be a valid number.";
        }
        if ($stock <= 0) {
            return "Product stock must be greater than zero.";
        }
        return true;
    }
}