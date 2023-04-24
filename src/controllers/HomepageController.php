<?php

namespace App\Controllers;

/**
 * Homepage Controller
 */
class HomepageController extends Controller
{
    /**
     * Appelle homepage
     */
    public function index()
    {
        $this->twig->display('homepage/index.html.twig');
    }
}