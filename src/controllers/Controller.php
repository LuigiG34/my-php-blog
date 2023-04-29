<?php

namespace App\Controllers;

use App\Config\Session;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Container;

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
        $this->loader = new FilesystemLoader(ROOT . '/templates');

        //Paramétré environnement twig
        $this->twig = new Environment($this->loader);

        $session = new Session;
        $alert = $session->getSession('alert');
        // Pass the session to Twig as a global variable
        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addGlobal('alert', $alert);
    }

    /**
     * Afficher un message après une requete
     *
     * @param string $type
     * @param string $message
     */
    public function alert(string $class, string $message)
    {
        $session = new Session;

        $session->setSession('alert', [
            "class" => $class,
            "msg" => $message
        ]);

        return $session->getSession('alert');
    }

    /**
     * Generate slug from post's title
     *
     * @param string $title
     */
    public function generateSlug(string $text)
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate divider
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
