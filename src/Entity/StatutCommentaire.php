<?php

namespace App\Entity;

/**
 * StatutCommentaire Entity file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */ 
class StatutCommentaire extends Entity
{
    protected string $idStatutCommentaire;
    protected string $type;


    /**
     * Get the value of idStatutCommentaire
     * 
     * @return string
     */ 
    public function getIdStatutCommentaire(): string
    {
        return $this->idStatutCommentaire;
    }


    /**
     * Set the value of idStatutCommentaire
     * 
     * @param string $idStatutCommentaire
     *
     * @return self
     */ 
    public function setIdStatutCommentaire(string $idStatutCommentaire): self
    {
        $this->idStatutCommentaire = $idStatutCommentaire;

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
     * @param string $type
     *
     * @return  self
     */ 
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
