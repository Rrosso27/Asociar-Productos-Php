<?php
require_once __DIR__ . '/../messages/MessageHandler.php';

class GroupValidations
{
    /**
     * grupo existe
     * @param mixed $name
     * @return bool|string
     */
    public function groupExistsByName($name)
    {
        $group = new Group();
        $result = $group->groupExistsByName($name);
        if ($result) {
            return "el grupo ya existe.";
        }
        return true;
    }
    /**
     *  validar nombre
     * @param mixed $name
     * @return bool|string|string[]
     */
    public function validateGroupName($name)
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
     * Validar Descripción
     * @param mixed $name
     * @return bool|string|string[]
     */
    public function validateGroupDescription($name)
    {
        $name = trim($name);
        if (empty($name)) {
            return MessageHandler::get('Form_description_required');
        }
        if (strlen($name) < 3) {
            return MessageHandler::get('Form_description_min_length');
        }
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
            return MessageHandler::get('Form_description_invalid');
        }
        return true;
    }
}