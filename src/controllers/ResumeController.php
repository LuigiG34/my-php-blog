<?php

namespace App\Controllers;

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
        $this->twig->display('resume/index.html.twig');
    }
}