<?php

namespace App\Validation;

class Validation
{
    public function notEmpty($array)
    {
        foreach($array as $var){
            if(empty($var)){
                return false;
            }
        }
    }

    public function validEmail($var)
    {
        if(!filter_var($var, FILTER_VALIDATE_EMAIL)){
            return false;
        }
    }

    public function signUpValid($email, $posts, $password, $passwordVerif)
    {
        if($this->validEmail($email) === false){
            return "L'adresse mail n'est pas valide.";
        }

        if($this->notEmpty($posts) === false){
            return "Un ou plusieurs champs sont vides.";
        }

        if($password !== $passwordVerif){
            return "Les mots de passes ne coresspondent pas.";
        }

        return true;
    }
}