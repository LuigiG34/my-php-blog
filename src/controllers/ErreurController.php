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
     * @return void
     */
    public function erreur401(): void
    {
        $this->render('errors/401', [], 'erreur');
        return;
    }


    /**
     * erreur404 function
     *
     * @return void
     */
    public function erreur404(): void
    {
        $this->render('errors/404', [], 'erreur');
        return;
    }

    
    /**
     * erreur500 function
     *
     * @return void
     */
    public function erreur500(): void
    {
        $this->render('errors/500', [], 'erreur');
        return;
    }

}
