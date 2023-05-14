<?php

namespace App\Entity;

use DateTime;

/**
 * Utilisateurs Entity file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Utilisateurs extends Entity
{
    protected string $idUtilisateur;
    protected string $prenom;
    protected string $email;
    protected string $motDePasse;
    protected string $tokenReset;
    protected DateTime|string $createdAt;
    protected DateTime|string $rgpdDate;
    protected string $role;
    protected string $isActif;


    /**
     * Get the value of idUtilisateur
     * 
     * @return string
     */ 
    public function getIdUtilisateur(): string
    {
        return $this->idUtilisateur;
    }


    /**
     * Set the value of idUtilisateur
     *
     * @param string $idUtilisateur
     * 
     * @return self
     */ 
    public function setIdUtilisateur(string $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }


    /**
     * Get the value of prenom
     * 
     * @return string
     */ 
    public function getPrenom(): string
    {
        return $this->prenom;
    }


    /**
     * Set the value of prenom
     * 
     * @param string $prenom Firstname of user
     *
     * @return self
     */ 
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }


    /**
     * Get the value of email
     * 
     * @return string
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }


    /**
     * Set the value of email
     * 
     * @param string $email User email
     *
     * @return self
     */ 
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    /**
     * Get the value of motDePasse
     * 
     * @return string
     */ 
    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }


    /**
     * Set the value of motDePasse
     *
     * @param string $motDePasse User password
     * 
     * @return self
     */ 
    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }


    /**
     * Get the value of tokenReset
     * 
     * @return string
     */ 
    public function getTokenReset(): string
    {
        return $this->tokenReset;
    }


    /**
     * Set the value of tokenReset
     *
     * @param string $tokenReset Token to reset password
     * 
     * @return self
     */ 
    public function setTokenReset($tokenReset): self
    {
        $this->tokenReset = $tokenReset;

        return $this;
    }


    /**
     * Get the value of createdAt
     * 
     * @return string|DateTime
     */ 
    public function getCreatedAt(): string|DateTime
    {
        return $this->createdAt;
    }


    /**
     * Set the value of createdAt
     *
     * @param string|DateTime $createdAt Date user was created in DB
     * 
     * @return self
     */ 
    public function setCreatedAt(string|DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    /**
     * Get the value of rgpdDate
     * 
     * @return string|DateTime
     */ 
    public function getRgpdDate(): string|DateTime
    {
        return $this->rgpdDate;
    }


    /**
     * Set the value of rgpdDate
     *
     * @param string|DateTime $rgpdDate Date user accepted RGPD
     * 
     * @return self
     */ 
    public function setRgpdDate($rgpdDate): self
    {
        $this->rgpdDate = $rgpdDate;

        return $this;
    }


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
     * @param string $role Users role
     * 
     * @return self
     */ 
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }


    /**
     * Get the value of isActif
     * 
     * @return string
     */ 
    public function getIsActif(): string
    {
        return $this->isActif;
    }

    /**
     * Set the value of isActif
     * 
     * @param string $isActif verify if user is actif or not
     *
     * @return  self
     */ 
    public function setIsActif(string $isActif): self
    {
        $this->isActif = $isActif;

        return $this;
    }
}
