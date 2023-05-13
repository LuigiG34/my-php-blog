<?php

namespace App\Config;

/**
 * Files Config file
 *
 * PHP Version 7.4
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Files
{
    private array $files;

    public function __construct()
    {
        $this->files = $_FILES;
    }


    /**
     * getFiles function
     *
     * @param string $name
     * @return mixed
     */
    public function getFiles(string $name): mixed
    {
        if (isset($this->files[$name])) {
            return $this->files[$name];
        }
    }


    /**
     * setFiles function
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function setFiles(string $name, mixed $value): void
    {
        $this->files[$name] = $value;
    }
}
