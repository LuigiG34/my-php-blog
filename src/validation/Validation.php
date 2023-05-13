<?php

namespace App\Validation;

/**
 * Validation file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Validation
{
    /**
     * notEmpty function
     *
     * @param array $array
     * 
     * @return boolean
     */
    public function notEmpty(array $array): bool
    {
        foreach ($array as $var) {
            if (empty($var)) {
                return false;
            }
            return true;
        }
    }


    /**
     * validEmail function
     *
     * @param string $var
     * 
     * @return boolean
     */
    public function validEmail(string $var): bool
    {
        if (!filter_var($var, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }


    /**
     * contactValid function
     *
     * @param string $email
     * @param array $posts
     * @param string $msg
     * @return boolean|string
     */
    public function contactValid(string $email, array $posts, string $msg): bool|string
    {
        if ($this->validEmail($email) === false) {
            return "L'adresse mail n'est pas valide.";
        }

        if ($this->notEmpty($posts) === false) {
            return "Un ou plusieurs champs sont vides.";
        }

        if (strlen($msg) < 20) {
            return 'Le champ Message doit contenir au moins 20 caractères.';
        }

        return true;
    }


    /**
     * signUpValid function
     *
     * @param string $email
     * @param array $posts
     * @param string $password
     * @param string $passwordVerif
     * @param object $data
     * @return string|boolean
     */
    public function signUpValid(string $email, array $posts, string $password, string $passwordVerif, object $data): string|bool
    {
        if ($this->validEmail($email) === false) {
            return "L'adresse mail n'est pas valide.";
        }

        if ($this->notEmpty($posts) === false) {
            return "Un ou plusieurs champs sont vides.";
        }

        $passwordRegex = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!(){}[\]<>?|]).{8,}$/';
        if (!preg_match($passwordRegex, $password)) {
            return 'Le mot de passe doit contenir au moins 8 caractères dont 1 lettre majuscule, 1 lettre minuscule, 1 symbole et 1 chiffre';
        }

        if ($password !== $passwordVerif) {
            return "Les mots de passes ne coresspondent pas.";
        }

        if ($data !== null) {
            return "L'adresse mail indiqué existe déjà en base de données.";
        }

        return true;
    }


    /**
     * modifierValid function
     *
     * @param string $email
     * @param array $posts
     * @return string|boolean
     */
    public function modifierValid(string $email, array $posts): string|bool
    {
        if ($this->validEmail($email) === false) {
            return "L'adresse mail n'est pas valide.";
        }

        if ($this->notEmpty($posts) === false) {
            return "Prénom et/ou email sont vides.";
        }

        return true;
    }


    /**
     * signInValid function
     *
     * @param string $email
     * @param array $posts
     * @param string $password
     * @param string $passwordVerif
     * @param object $data
     * @return string|boolean
     */
    public function signInValid(string $email, array $posts, string $password, string $passwordVerif, object $data): string|bool
    {
        if ($this->validEmail($email) === false) {
            return "L'adresse mail n'est pas valide.";
        }

        if ($this->notEmpty($posts) === false) {
            return "Un ou plusieurs champs sont vides.";
        }

        if (password_verify($password, $passwordVerif) === false) {
            return "L'adresse mail et/ou le mot de passe est incorrect.";
        }

        if ($data === null) {
            return "L'adresse mail et/ou le mot de passe est incorrect.";
        }

        return true;
    }


    /**
     * forgotPassValid function
     *
     * @param string $email
     * @param array $posts
     * @param object $data
     * @return string|boolean
     */
    public function forgotPassValid(string $email, array $posts, object $data): string|bool
    {
        if ($this->validEmail($email) === false) {
            return "L'adresse mail n'est pas valide.";
        }

        if ($this->notEmpty($posts) === false) {
            return "Un ou plusieurs champs sont vides.";
        }

        if ($data === null) {
            return "L'adresse mail indiqué existe pas en base de données.";
        }

        return true;
    }


    /**
     * newPassValid function
     *
     * @param string $password
     * @param array $posts
     * @return string|boolean
     */
    public function newPassValid(string $password, array $posts): string|bool
    {
        $passwordRegex = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!(){}[\]<>?|]).{8,}$/';
        if (!preg_match($passwordRegex, $password)) {
            return 'Le mot de passe doit contenir au moins 8 caractères dont 1 lettre majuscule, 1 lettre minuscule, 1 symbole et 1 chiffre';
        }

        if ($this->notEmpty($posts) === false) {
            return "Un ou plusieurs champs sont vides.";
        }

        return true;
    }


    /**
     * addArticleValid function
     *
     * @param array $posts
     * @return string|boolean
     */
    public function addArticleValid(array $posts, string $chapo,string $title, string $content): string|bool
    {
        if ($this->notEmpty($posts) === false) {
            return "Un ou plusieurs champs sont vides.";
        }

        if(strlen($content) < 150) {
            return "Le contenu de votre article doit dépasser 150 caractères.";
        }

        if(strlen($chapo) < 50) {
            return "Le contenu de votre article doit dépasser 50 caractères.";
        }

        if(strlen($title) > 255) {
            return "Le titre de votre article ne doit pas dépasser 255 caractères.";
        }

        return true;
    }


    /**
     * addCommentValid function
     *
     * @param string $contenu
     * @return string|boolean
     */
    public function addCommentValid(string $contenu): string|bool
    {
        if (empty($contenu) === false) {
            return "Un ou plusieurs champs sont vides.";
        }

        if(strlen($contenu) < 15) {
            return "Le contenu de votre commentaire doit dépasser 15 caractères.";
        }

        return true;
    }
}
