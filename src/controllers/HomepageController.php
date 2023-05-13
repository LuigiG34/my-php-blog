<?php

namespace App\Controllers;

/**
 * Homepage Controller file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class HomepageController extends Controller
{
    /**
     * index function
     *
     * @return mixed
     */
    public function index()
    {
        return $this->render('homepage/index');
    }
}