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
        $this->render('articles/articles-archive');
    }
}