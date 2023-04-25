<?php

namespace App\Config;

/**
 * Class Files for $_FILES
 */
class Files
{
    private $files;

    public function __construct()
    {
        self::$files = $_FILES;
    }

    /**
     * Get the value of files
     *
     * @param string $name
     */
    static public function getFiles($name)
    {
        if(isset(self::$files[$name])) {
            return self::$files[$name];
        }
    }


    /**
     * Set the value of files
     * 
     * @param string $name
     * @param array|string $value
     */
    static public function setFiles($name, $value)
    {
        self::$files[$name] = $value;
    }

}