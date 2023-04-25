<?php

namespace App\Config;

/**
 * Class Session for $_SESSION
 */
class Session
{
    private $session;

    public function __construct()
    {
        self::$session = $_SESSION;
    }

    /**
     * Get the value of session
     *
     * @param string $name
     */
    static public function getSession($name)
    {
        if(isset(self::$session[$name])) {
            return self::$session[$name];
        }
    }


    /**
     * Set the value of session
     * 
     * @param string $name
     * @param array|string $value
     */
    static public function setSession($name, $value)
    {
        self::$session[$name] = $value;
    }


    /**
     * Unset session
     *
     * @param string $name
     */
    static public function unsetSession($name)
    {
        unset(self::$session[$name]);
    }
}