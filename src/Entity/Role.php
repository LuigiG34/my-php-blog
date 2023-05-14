<?php

namespace App\Entity;

/**
 * Role Entity file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Role extends Entity
{
    protected string $idRole;
    protected string $role;


    /**
     * Get the value of role
     * 
     * @return string
     */ 
    public function getRole(): string
    {
        return $this->role;
    }

    
    /**
     * Set the value of role
     *
     * @param string $role
     * 
     * @return self
     */ 
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }


    /**
     * Get the value of idRole
     * 
     * @return string
     */ 
    public function getIdRole(): string
    {
        return $this->idRole;
    }


    /**
     * Set the value of idRole
     *
     * @param string $idRole
     * 
     * @return self
     */ 
    public function setIdRole(string $idRole): self
    {
        $this->idRole = $idRole;

        return $this;
    }
}
