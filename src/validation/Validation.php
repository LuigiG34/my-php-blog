<?php

namespace App\Validation;

class Validation
{
    public function notEmpty($var)
    {
        if(empty($var)){
            return false;
        }
    }

    public function validEmail($var)
    {
        if(!filter_var($var, FILTER_VALIDATE_EMAIL)){
            return false;
        }
    }
}