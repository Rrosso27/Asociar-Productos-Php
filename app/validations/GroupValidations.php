<?php

class GroupValidations
{
    /**
     *  validar nombre
     * @param mixed $name
     * @return bool|string|string[]
     */
    public function validateGroupName($name)
    {
        $name = trim($name);
        if (empty($name)) {
            return ["Group name cannot be empty."];
        }
        if (strlen($name) < 3) {
            return "Group name must be at least 3 characters long.";
        }
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
            return "Group name can only contain letters, numbers, and spaces.";
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
            return ["Group name cannot be empty."];
        }
        if (strlen($name) < 3) {
            return "Group name must be at least 3 characters long.";
        }
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
            return "Group name can only contain letters, numbers, and spaces.";
        }
        return true;
    }
}