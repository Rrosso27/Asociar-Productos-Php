<?php

class MessageHandler
{
    private static $messages = [
        'Form_name_required' => "El nombre es requerido.",
        'Form_name_min_length' => "El nombre debe tener al menos 3 caracteres.",
        'Form_name_invalid' => "El nombre no está permitido.",
        'Form_description_required' => "La descripción es requerida.",
        'Form_description_min_length' => "La descripción debe tener al menos 3 caracteres.",
        'Form_description_invalid' => "La descripción no está permitido.",
        'Form_email_required' => "El correo electrónico es requerido.",
        'Form_email_invalid' => "El formato del correo electrónico no es válido.",
        "product_exit" => "El producto ya existe.",
        "Product_price_required" => "El precio es requerido.",
        "Product_price_invalid" => "El precio no es válido.",
        "Product_stock" => "El stock es requerido.",
        "Product_stock_invalid" => "El stock no es válido.",
    ];

    /**
     * Get a message by key.
     *
     * @param string $key
     * @return string|null
     */
    public static function get($key)
    {
        return self::$messages[$key] ?? null;
    }
}