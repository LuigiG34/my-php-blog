<?php

namespace App\Entity;

use DateTime;

/**
 * Articles Entity file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Articles extends Entity
{
    protected string $idArticle;
    protected string $titre;
    protected string $chapo;
    protected string $contenu;
    protected DateTime|string $createdAt;
    protected DateTime|string $updatedAt;
    protected string $img;
    protected string $slug;
    protected string $categorie;
    protected string $auteur;


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
     * @param string $auteur Auteur de l'article
     * 
     * @return self
     */
    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }


    /**
     * Get the value of categorie
     * 
     * @return string
     */
    public function getCategorie(): string
    {
        return $this->categorie;
    }


    /**
     * Set the value of categorie
     *
     * @param string $categorie categorie de l'article
     * 
     * @return self
     */
    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }


    /**
     * Get the value of slug
     * 
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }


    /**
     * Set the value of slug
     *
     * @param string $slug Slug of article
     * 
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }


    /**
     * Get the value of img
     * 
     * @return string
     */
    public function getImg(): string
    {
        return $this->img;
    }


    /**
     * Set the value of img
     *
     * @param string $img Name of image file
     * 
     * @return self
     */
    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }


    /**
     * Get the value of updatedAt
     * 
     * @return DateTime|string 
     */
    public function getUpdatedAt(): DateTime|string
    {
        return $this->updatedAt;
    }


    /**
     * Set the value of updatedAt
     * 
     * @param DateTime|string $updatedAt Date the article was updated
     *
     * @return self
     */
    public function setUpdatedAt(string|DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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
     * @param DateTime|string $createdAt Date the article was created
     * 
     * @return self
     */
    public function setCreatedAt(string|DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

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
     * @param string $contenu Content of the article
     * 
     * @return self
     */
    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }


    /**
     * Get the value of chapo
     * 
     * @return string
     */
    public function getChapo(): string
    {
        return $this->chapo;
    }


    /**
     * Set the value of chapo
     *
     * @param string $chapo Chapo de l'article
     * 
     * @return self
     */
    public function setChapo(string $chapo): self
    {
        $this->chapo = $chapo;

        return $this;
    }


    /**
     * Get the value of titre
     * 
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }


    /**
     * Set the value of titre
     * 
     * @param string $titre Titre de l'article
     *
     * @return self
     */
    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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
}
