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
        self::$get = $_GET;
    }

    /**
     * Get the value of get
     *
     * @param string $name
     */
    static public function getGet($name)
    {
        if(isset(self::$get[$name])) {
            return self::$get[$name];
        }
    }


    /**
     * Get the value of get
     *
     * @param string $name
     */
    static public function getAllGet()
    {
        if(isset(self::$get)) {
            return self::$get;
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
        self::$get[$name] = $value;
    }

}