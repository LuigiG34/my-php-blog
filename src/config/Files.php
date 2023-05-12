<?php

namespace App\Config;


class Files
{
    private $files;

    public function __construct()
    {
        $this->files = $_FILES;
    }


    public function getFiles($name)
    {
        if (isset($this->files[$name])) {
            return $this->files[$name];
        }
    }


    public function setFiles($name, $value)
    {
        $this->files[$name] = $value;
    }
}
