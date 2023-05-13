<?php

namespace App\Config;

/**
 * Post Config file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Post
{
    private array $post;

    public function __construct()
    {
        $this->post = $_POST;
    }


    /**
     * getPost function
     *
     * @param string $name
     * @return array|string
     */
    public function getPost(string $name): array|string
    {
        if (isset($this->post[$name])) {
            return $this->post[$name];
        }
    }


    /**
     * getAllPost function
     *
     * @return array
     */
    public function getAllPost(): array
    {
        if (isset($this->post)) {
            return $this->post;
        }
    }


    /**
     * setPost function
     *
     * @param string $name
     * @param array|string $value
     * @return void
     */
    public function setPost(string $name, array|string $value): void
    {
        $this->post[$name] = $value;
    }
}
