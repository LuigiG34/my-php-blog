<?php

namespace App\Core;

use App\Config\Get;
use App\Controllers\HomepageController;


class Routeur
{

    public function start()
    {
        // On démarre la session.
        session_start();

        // On recupere l'URL.
        $uri = $_SERVER['REQUEST_URI'];

        // On retire le trailing slash eventuel de l'URL.
        // On va vérifié que uri n'est pas vide et se termine par un /.
        if (!empty($uri) && $uri != '/' && $uri[-1] === "/") {
            // On enleve le /.
            $uri = substr($uri, 0, -1);

            // On renvoie un code de redirection permanente.
            http_response_code(301);

            // On redirige vers l'URL sans /.
            header('Location:' . $uri);
        }

        // On gère les paramètres d'URL.
        // On sépare les paramètres dans un tableau.
        $get = new Get;
        $params = explode('/', $get->getGet('p'));

        if ($params[0] === '') {
            // On instancie le controleur par défaut.
            $controller = new HomepageController;

            // On apppelle l'index.
            return $controller->index();
        }

        // On a au moins un parametres dans l'URL.
        // On récupère le nom du controleur à instancier.
        // On met une majuscule en 1ere lettre, on ajoute le namespace complet avant et on ajoute "Controller".
        $controller = '\\App\\Controllers\\' . ucfirst(array_shift($params)) . 'Controller';

        if (class_exists($controller) === false) {
            // Sinon on renvoie une erreur 404.
            http_response_code(404);
            header('Location: /erreur/erreur404');
        }


        // On instancie le controleur.
        $controller = new $controller;

        // Est-ce qu'on a un deuxieme paramètre ? Sinon appelle la méthode index().
        $action = (isset($params[0])) ? array_shift($params) : 'index';

        if (method_exists($controller, $action) === false) {
            // Sinon on renvoie une erreur 404.
            http_response_code(404);
            header('Location: /erreur/erreur404');
        }

        // Si il reste des parametres on les passes à la méthode.
        // Au lieu d'utilisé $controller->$action($params) on utilise call_user_func_array() qui appel une méthode en lui donnant un paramètre qui n'est pas un tableau.
        if (!isset($params[0])) {
            return $controller->$action();
        }

        if(call_user_func_array([$controller, $action], $params)) {
            http_response_code(500);
            header('Location: /erreur/erreur500');
        }
    }
}
