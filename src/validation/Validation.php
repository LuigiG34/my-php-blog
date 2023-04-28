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

    public function signUpValid($email, $posts, $password, $passwordVerif, $data)
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

        if($data !== null) {
            return "L'adresse mail indiqué existe déjà en base de données.";
        }

        return true;
    }

    public function signInValid($email, $posts, $password, $passwordVerif, $data)
    {
        if($this->validEmail($email) === false){
            return "L'adresse mail n'est pas valide.";
        }

        if($this->notEmpty($posts) === false){
            return "Un ou plusieurs champs sont vides.";
        }

        if(password_verify($password, $passwordVerif) === false){
            return "L'adresse mail et/ou le mot de passe est incorrect.";
        }

        if($data !== null) {
            return "L'adresse mail et/ou le mot de passe est incorrect.";
        }

        return true;
    }
}