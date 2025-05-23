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
        "product_no_found" => "El producto no fue encontrado.",
        "product_exists_grup" => "El producto ya existe en el grupo.",
        "group_no_found"=> "El grupo no fue encontrado.",
        "group_add_success" => "El grupo se ha añadido con éxito.",
        "group_upd_success" => "El grupo se ha actualizado con éxito.",
        "group_delete_success"=> "El grupo se ha eliminado con éxito.",
        "group_delete_error"=> "Error al eliminar el grupo.",
        "group_add_error"=> "Error al guardar el Grupo",
        "Group_id_required" => "El ID del grupo es requerido.",
        "Group_id_invalid" => "El ID del grupo no es válido.",
        "Product_id_required" => "El ID del producto es requerido.",
        "Product_id_invalid" => "El ID del producto no es válido.",
        "Product_no_found"=> "El producto no fue encontrado.",
        "Product_add_success" => "El producto se ha añadido con éxito.",
        "Product_upd_success" => "El producto se ha actualizado con éxito.",
        "Product_add_error"=> "Error al añadir el producto.",
        "Product_delete_success"=> "El producto se ha eliminado con éxito.",
        "Product_delete_error"=> "Error al eliminar el producto.",
    ];

    /**
     * Recibir un mensaje por clave.
     *
     * @param string $key
     * @return string|null
     */
    public static function get($key)
    {
        return self::$messages[$key] ?? null;
    }
}