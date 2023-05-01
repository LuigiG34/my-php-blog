<?php

namespace App\Controllers;

use App\Config\Session;

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
        $this->render('homepage/index');
    }
}