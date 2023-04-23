<?php

namespace App\controllers;

/**
 * Homepage Controller
 */
class HomepageController extends Controller
{
    /**
     * Appelle homepage
     *
     * @return void
     */
    public function index()
    {
        $this->render('homepage/index');
    }
}