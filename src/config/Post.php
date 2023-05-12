<?php

namespace App\Config;


class Post
{
    private $post;

    public function __construct()
    {
        $this->post = $_POST;
    }


    public function getPost($name)
    {
        if (isset($this->post[$name])) {
            return $this->post[$name];
        }
    }


    public function getAllPost()
    {
        if (isset($this->post)) {
            return $this->post;
        }
    }


    public function setPost($name, $value)
    {
        $this->post[$name] = $value;
    }
}
