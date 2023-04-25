<?php

namespace App\Config;

/**
 * Class Get for $_GET
 */
class Get
{
    private $get;

    public function __construct()
    {
        $this->get = $_GET;
    }

    /**
     * Get the value of get
     *
     * @param string $name
     */
    public function getGet($name)
    {
        if(isset($this->get[$name])) {
            return $this->get[$name];
        }
    }


    /**
     * Get the value of get
     *
     * @param string $name
     */
    public function getAllGet()
    {
        if(isset($this->get)) {
            return $this->get;
        }
    }


    /**
     * Set the value of get
     * 
     * @param string $name
     * @param array|string $value
     */
    public function setGet($name, $value)
    {
        $this->get[$name] = $value;
    }

}