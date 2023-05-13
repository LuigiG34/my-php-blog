<?php

namespace App\Entity;

/**
 * Categorie Entity file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Categorie
{
    protected string $idCategorie;
    protected string $type;
    protected string $description;


    /**
     * Get the value of description
     * 
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }


    /**
     * Set the value of description
     *
     * @param string $description contenu du commentaire
     * 
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


    /**
     * Get the value of type
     * 
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }


    /**
     * Set the value of type
     * 
     * @param string $type Type of category
     *
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }


    /**
     * Get the value of idCategorie
     * 
     * @return string
     */
    public function getIdCategorie(): string
    {
        return $this->idCategorie;
    }


    /**
     * Set the value of idCategorie
     * 
     * @param string $idCategorie
     *
     * @return self
     */
    public function setIdCategorie(string $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }
}
