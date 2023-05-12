<?php

namespace App\Config;


class Get
{
    private $get;

    public function __construct()
    {
        $this->get = $_GET;
    }


    public function getGet($name)
    {
        if (isset($this->get[$name])) {
            return $this->get[$name];
        }
    }


    public function getAllGet()
    {
        if (isset($this->get)) {
            return $this->get;
        }
    }


    public function setGet($name, $value)
    {
        $this->get[$name] = $value;
    }
}
