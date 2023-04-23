<?php

namespace App\config;

/**
 * Class Session for $_SESSION
 */
class Session
{
    private $session;

    public function __construct()
    {
        $this->session = $_SESSION;
    }

    /**
     * Get the value of session
     *
     * @param string $name
     */
    public function getSession($name)
    {
        if(isset($this->session[$name])) {
            return $this->session[$name];
        }
    }


    /**
     * Set the value of session
     * 
     * @param string $name
     * @param array|string $value
     */
    public function setSession($name, $value)
    {
        $this->session[$name] = $value;
    }


    /**
     * Unset session
     *
     * @param string $name
     */
    public function unsetSession($name)
    {
        unset($this->session[$name]);
    }
}