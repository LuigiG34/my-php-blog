<?php

namespace App\Entity;

use DateTime;

/**
 * Commentaire Entity file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Commentaire extends Entity
{
    protected string $idCommentaire;
    protected string $contenu;
    protected DateTime|string $createdAt;
    protected string $idArticle;
    protected string $article;
    protected string $auteur;
    protected string $statut;
    protected ?string $idAdmin;
    protected string $idStatutCommentaire;


    /**
     * Get the value of idCommentaire
     * 
     * @return string
     */ 
    public function getIdCommentaire(): string
    {
        return $this->idCommentaire;
    }


    /**
     * Set the value of idCommentaire
     * 
     * @param string $idCommentaire
     *
     * @return self
     */ 
    public function setIdCommentaire(string $idCommentaire): self
    {
        $this->idCommentaire = $idCommentaire;

        return $this;
    }


    /**
     * Get the value of contenu
     * 
     * @return string
     */ 
    public function getContenu(): string
    {
        return $this->contenu;
    }


    /**
     * Set the value of contenu
     * 
     * @param string $contenu Content of comment
     *
     * @return self
     */ 
    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }


    /**
     * Get the value of createdAt
     * 
     * @return DateTime|string
     */ 
    public function getCreatedAt(): DateTime|string
    {
        return $this->createdAt;
    }


    /**
     * Set the value of createdAt
     * 
     * @param DateTime|string $createdAt Date of comments creation 
     *
     * @return self
     */ 
    public function setCreatedAt(DateTime|string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    /**
     * Get the value of idArticle
     * 
     * @return string
     */ 
    public function getIdArticle(): string
    {
        return $this->idArticle;
    }


    /**
     * Set the value of idArticle
     *
     * @param string $idArticle
     * 
     * @return self
     */ 
    public function setIdArticle(string $idArticle): self
    {
        $this->idArticle = $idArticle;

        return $this;
    }


    /**
     * Get the value of article
     * 
     * @return string
     */ 
    public function getArticle(): string
    {
        return $this->article;
    }


    /**
     * Set the value of article
     * 
     * @param string $article Title of article
     *
     * @return self
     */ 
    public function setArticle(string $article): self
    {
        $this->article = $article;

        return $this;
    }


    /**
     * Get the value of auteur
     * 
     * @return string
     */ 
    public function getAuteur(): string
    {
        return $this->auteur;
    }


    /**
     * Set the value of auteur
     * 
     * @param string $auteur Author of comment
     *
     * @return self
     */ 
    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }


    /**
     * Get the value of statut
     * 
     * @return string
     */ 
    public function getStatut(): string
    {
        return $this->statut;
    }


    /**
     * Set the value of statut
     * 
     * @param string $statut Status of the comment
     *
     * @return self
     */ 
    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }


    /**
     * Get the value of idAdmin
     * 
     * @return ?string
     */ 
    public function getIdAdmin(): ?string
    {
        return $this->idAdmin;
    }

    
    /**
     * Set the value of idAdmin
     * 
     * @param ?string $idAdmin
     *
     * @return self
     */ 
    public function setIdAdmin(?string $idAdmin): self
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }


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
}
