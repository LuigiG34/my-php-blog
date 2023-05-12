<?php

namespace App\Controllers;


abstract class Controller
{

    public function render(string $fichier, array $donnees = [], string $template = 'base')
    {
        // On extrait le contenu de $donnees
        extract($donnees);

        // On démarre le buffer de sortie
        // A partir de ce point toute sortie (echo ou HTML) est conservé en mémoire
        ob_start();

        // On créé le chemin vers la vue
        require_once ROOT . '/templates/' . $fichier . '.php';

        // On stocke dans la variable le buffer
        $contenu = ob_get_clean();

        // On recupere notre template
        require_once ROOT . '/templates/'.$template.'.php';
    }

    
    public function alert(string $class, string $message)
    {
        $_SESSION['alert'] = [
            "class" => $class,
            "msg" => $message
        ];

        return $_SESSION['alert'];
    }

    
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
