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
     * @return array|string|null
     */
    public function getPost(string $name): array|string|null
    {
        return $this->post[$name]??null;
    }


    /**
     * getAllPost function
     *
     * @return array|null
     */
    public function getAllPost(): array|null
    {
        return $this->post??null;
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
