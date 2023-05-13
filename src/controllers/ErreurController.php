<?php

namespace App\Controllers;

/**
 * Erreur Controller file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class ErreurController extends Controller
{

    /**
     * erreur401 function
     *
     * @return mixed
     */
    public function erreur401(): mixed
    {
        return $this->render('errors/401', [], 'erreur');
    }


    /**
     * erreur404 function
     *
     * @return mixed
     */
    public function erreur404(): mixed
    {
        return $this->render('errors/404', [], 'erreur');
    }

    
    /**
     * erreur500 function
     *
     * @return mixed
     */
    public function erreur500(): mixed
    {
        return $this->render('errors/500', [], 'erreur');
    }

}