<?php

namespace App\Config;


class Session
{
    private $session;

    public function __construct()
    {
        $this->session = $_SESSION;
    }


    public function getSession($name)
    {
        if (isset($this->session[$name])) {
            return $this->session[$name];
        } else {
            return null;
        }
    }


    public function setSession($name, $value)
    {
        $this->session[$name] = $value;
    }


    public function unsetSession($name)
    {
        unset($this->session[$name]);
    }
}
