<?php

namespace App\Config;

/**
 * Session Config file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Session
{
    private array $session;

    public function __construct()
    {
        $this->session = $_SESSION;
    }


    /**
     * getSession function
     * 
     * Get the $_SESSION with its name
     *
     * @param string $name
     * 
     * @return array|string|null
     */
    public function getSession(array|string $name): array|string|null
    {
        if (isset($this->session[$name])) {
            return $this->session[$name];
        } else {
            return null;
        }
    }


    /**
     * setSession function
     *
     * @param string $name
     * @param array|string $value
     * @return void
     */
    public function setSession(string $name, array|string $value): void
    {
        $this->session[$name] = $value;
    }


    /**
     * unsetSession function
     *
     * @param string $name
     * @return void
     */
    public function unsetSession(string $name): void
    {
        unset($this->session[$name]);
    }
}
