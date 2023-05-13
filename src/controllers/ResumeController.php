<?php

namespace App\Controllers;

/**
 * Resume Controller file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class ResumeController extends Controller
{
    /**
     * index function
     *
     * @return void
     */
    public function index(): void
    {
        $this->render('resume/index');
        return;
    }
    
}
