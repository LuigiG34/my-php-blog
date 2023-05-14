<?php

namespace App\Entity;

/**
 * Abstract Entity file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
abstract class Entity
{
    /**
     * hydrate function
     *
     * @param object|array $data
     * @return void
     */
    public function hydrate(object|array $data): void
    {
        foreach ($data as $attribut => $value) {
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));
            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }
}

