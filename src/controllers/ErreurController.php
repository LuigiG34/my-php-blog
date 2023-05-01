<?php

namespace App\Controllers;

class ErreurController extends Controller
{

    public function erreur401()
    {
        $this->render('errors/401', [], 'erreur');
    }

    public function erreur404()
    {
        $this->render('errors/404', [], 'erreur');
    }

    public function erreur500()
    {
        $this->render('errors/500', [], 'erreur');
    }

}