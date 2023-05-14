<?php

use App\Core\Routeur;

// On importe l'Autoloader.
require_once __DIR__  . '/../vendor/autoload.php';

// On instancie Main
$app = new Routeur;

// On démarre l'application.
$app->start();
