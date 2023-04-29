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
        $session = new Session;
        $user = $session->getSession('user');
        $alert = $session->getSession('alert');
        $this->twig->addGlobal('alert', $alert);
        $this->twig->addGlobal('user', $user);

        $this->twig->display('resume/index.html.twig', [
            'alert' => $alert,
            'user' => $user
        ]);
    }
}
