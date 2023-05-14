<?php

namespace App\Config;

/**
 * Get Config file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Get
{
    private array $get;

    public function __construct()
    {
        $this->get = $_GET;
    }


    /**
     * getGet function
     *
     * @param string $name
     * @return array|string|null
     */
    public function getGet(string $name): array|string|null
    {
        return $this->get[$name]??null;
    }


    /**
     * getAllGet function
     *
     * @return array
     */
    public function getAllGet(): array
    {
        if (isset($this->get)) {
            return $this->get;
        }
    }


    /**
     * setGet function
     *
     * @param string $name
     * @param mixed $value
     * 
     * @return void
     */
    public function setGet(string $name, array|string $value): void
    {
        $this->get[$name] = $value;
    }
}
