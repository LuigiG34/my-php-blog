<?php

namespace App\Config;

/**
 * Files Config file
 *
 * PHP Version 8.0
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
     * @return array|string|null
     */
    public function getFiles(string $name): array|string|null
    {
        return $this->files[$name]??null;
    }


    /**
     * setFiles function
     *
     * @param string $name
     * @param array|string $value
     * @return void
     */
    public function setFiles(string $name, array|string $value): void
    {
        $this->files[$name] = $value;
    }
}
