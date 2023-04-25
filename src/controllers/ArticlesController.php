<?php

namespace App\Controllers;

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
        $this->twig->display('articles/articles-archive.html.twig');
    }
}