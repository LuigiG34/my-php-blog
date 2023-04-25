<?php

namespace App\Config;

/**
 * Class Post for $_POST
 */
class Post
{
    private $post;

    public function __construct()
    {
        self::$post = $_POST;
    }

    /**
     * Get the value of post
     *
     * @param string $name
     */
    static public function getPost($name)
    {
        if(isset(self::$post[$name])) {
            return self::$post[$name];
        }
    }

    /**
     * Get the value of All post
     *
     * @param string $name
     */
    static public function getAllPost()
    {
        if(isset(self::$post)) {
            return self::$post;
        }
    }

    /**
     * Set the value of post
     * 
     * @param string $name
     * @param array|string $value
     */
    static public function setPost($name, $value)
    {
        self::$post[$name] = $value;
    }

}