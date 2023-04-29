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
        $session = new Session;
        $user = $session->getSession('user');
        $alert = $session->getSession('alert');
        $this->twig->addGlobal('alert', $alert);
        $this->twig->addGlobal('user', $user);

        $this->twig->display('homepage/index.html.twig', [
            'alert' => $alert,
            'user' => $user
        ]);
    }
}