<?php

namespace App\Controllers;

class ErreurController extends Controller
{

    public function erreur401()
    {
        return $this->render('errors/401', [], 'erreur');
    }


    public function erreur404()
    {
        return $this->render('errors/404', [], 'erreur');
    }

    
    public function erreur500()
    {
        return $this->render('errors/500', [], 'erreur');
    }

}