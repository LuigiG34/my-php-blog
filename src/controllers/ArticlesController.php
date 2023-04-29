<?php

namespace App\Controllers;

use App\Config\Session;

/**
 * ArticlesController
 */
class ArticlesController extends Controller
{
    /**
     * Appelle archive d'articles
     */
    public function index()
    {
        $session = new Session;
        $user = $session->getSession('user');
        $alert = $session->getSession('alert');
        $this->twig->addGlobal('alert', $alert);
        $this->twig->addGlobal('user', $user);

        $this->twig->display('articles/articles-archive.html.twig', [
            'alert' => $alert,
            'user' => $user
        ]);
    }
}