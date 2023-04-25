<?php

namespace App\Controllers;

/**
 * ContactController
 */
class ContactController extends Controller
{
    /**
     * Appelle contact
     */
    public function index()
    {
        $this->twig->display('contact/index.html.twig');
    }
}