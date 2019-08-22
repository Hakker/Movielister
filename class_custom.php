<?php

class custom_functions
{
    static public function validate_object($object, $keys)
    {
        foreach ($keys as $value) {
            if (!isset($object->$value)) {
                return false;
            }
        }
        return true;
    }
}