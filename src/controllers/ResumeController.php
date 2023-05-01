<?php

namespace App\Controllers;

use App\Config\Session;

/**
 * ResumeController
 */
class ResumeController extends Controller
{
    /**
     * Appelle contact
     */
    public function index()
    {
        $this->render('resume/index');
    }
}
