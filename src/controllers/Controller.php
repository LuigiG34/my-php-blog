<?php

namespace App\Controllers;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/**
 * Controller class
 */
abstract class Controller
{
    private $loader;
    protected $twig;

    public function __construct()
    {
        // Paramétré le dossier contenant nos templates twig
        $this->loader = new FilesystemLoader(ROOT.'/templates');

        //Paramétré environnement twig
        $this->twig = new Environment($this->loader);
    }
}