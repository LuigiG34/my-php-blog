<?php

use App\Core\Routeur;

// On definie une constante contenant le dossier racine du projet.
define('ROOT', __DIR__.'/..');

// On importe l'Autoloader.
require_once ROOT.'/vendor/autoload.php';

// On instancie Main
$app = new Routeur;

// On démarre l'application.
$app->start();
