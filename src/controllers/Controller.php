<?php

namespace App\controllers;

/**
 * Controller class
 */
abstract class Controller
{
    /**
     * render function (render template)
     *
     * @param string $fichier views file
     * @param array $donnees variable or array with data
     * @param string $template data 'default' or 'admin'
     */
    public function render(string $fichier, array $donnees = [], string $template = 'default')
    {
        // On extrait le contenu de $donnees.
        extract($donnees);

        // On démarre le buffer de sortie.
        // A partir de ce point toute sortie (echo ou HTML) est conservé en mémoire.
        ob_start();

        // On créé le chemin vers la vue.
        require_once ROOT . '/templates/' . $fichier . '.php';

        // On stocke dans la variable le buffer.
        $contenu = ob_get_clean();

        // On recupere notre template.
        require_once ROOT . '/templates/'.$template.'.php';
    }
}