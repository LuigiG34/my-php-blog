<?php

namespace App\config;

/**
 * Class Files for $_FILES
 */
class Files
{
    private $files;

    public function __construct()
    {
        $this->files = $_FILES;
    }

    /**
     * Get the value of files
     *
     * @param string $name
     */
    public function getFiles($name)
    {
        if(isset($this->files[$name])) {
            return $this->files[$name];
        }
    }


    /**
     * Set the value of files
     * 
     * @param string $name
     * @param array|string $value
     */
    public function setFiles($name, $value)
    {
        $this->files[$name] = $value;
    }

}