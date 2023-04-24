<?php

namespace App\config;

/**
 * Class Post for $_POST
 */
class Post
{
    private $post;

    public function __construct()
    {
        $this->post = $_POST;
    }

    /**
     * Get the value of post
     *
     * @param string $name
     */
    public function getPost($name)
    {
        if(isset($this->post[$name])) {
            return $this->post[$name];
        }
    }

    /**
     * Get the value of All post
     *
     * @param string $name
     */
    public function getAllPost()
    {
        if(isset($this->post)) {
            return $this->post;
        }
    }

    /**
     * Set the value of post
     * 
     * @param string $name
     * @param array|string $value
     */
    public function setPost($name, $value)
    {
        $this->post[$name] = $value;
    }

}