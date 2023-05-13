<?php

namespace App\Controllers;


class HomepageController extends Controller
{
    
    public function index()
    {
        return $this->render('homepage/index');
    }
}