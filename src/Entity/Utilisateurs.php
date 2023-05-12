<?php

namespace App\Entity;

class Utilisateurs
{
    protected $idUtilisateur;
    protected $prenom;
    protected $email;
    protected $motDePasse;
    protected $tokenReset;
    protected $createdAt;
    protected $rgpdDate;
    protected $role;
    protected $isActif;


    public function getRole()
    {
        return $this->role;
    }


    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }


    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    public function getRgpdDate()
    {
        return $this->rgpdDate;
    }


    public function setRgpdDate($rgpdDate)
    {
        $this->rgpdDate = $rgpdDate;

        return $this;
    }


    public function getTokenReset()
    {
        return $this->tokenReset;
    }


    public function setTokenReset($tokenReset)
    {
        $this->tokenReset = $tokenReset;

        return $this;
    }


    public function getMotDePasse()
    {
        return $this->motDePasse;
    }


    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getPrenom()
    {
        return $this->prenom;
    }


    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }


    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }


    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    
    public function getIsActif()
    {
        return $this->isActif;
    }

    
    public function setIsActif($isActif)
    {
        $this->isActif = $isActif;

        return $this;
    }
}
