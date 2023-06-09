<?php

namespace App\Core;

// On importe PDO.
use PDO;
use PDOException;

/**
 * Database file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Db extends PDO
{
    // Instance unique de la classe.
    private static $instance;


    private function __construct()
    {
        // On récupère les var dans la config.ini.
        $config = parse_ini_file(ROOT . '/config.ini');
        // DSN de connexion.
        $_dsn = 'mysql:dbname=' . $config['DB_NAME'] . ";host=" . $config['DB_HOST'];

        // On execute un try/catch au cas où la connexion ne fonctionne pas.
        try {
            // On appelle le constructeur de la classe PDO.
            parent::__construct($_dsn, $config['DB_USERNAME'], $config['DB_PASSWORD']);

            // Permet d'effectuer les transitions sur de l'UTF-8.
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            // Permet d'effectuer tout nos fetch/fetchAll en tableau associatif.
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            // Definir le mode de transfert d'erreur.
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    /**
     * getInstance function
     *
     * @return self
     */
    public static function getInstance(): self
    {
        // Si la bdd n'est pas instancié, on l'instancie.
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
