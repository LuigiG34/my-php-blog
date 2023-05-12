<?php

namespace App\Entity;

class Categorie
{
    protected $idCategorie;
    protected $type;
    protected $description;


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }


    public function getType()
    {
        return $this->type;
    }


    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }


    public function getIdCategorie()
    {
        return $this->idCategorie;
    }


    public function setIdCategorie($idCategorie)
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }
}
