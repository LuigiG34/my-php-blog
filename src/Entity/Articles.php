<?php

namespace App\Entity;

class Articles
{
    protected $idArticle;
    protected $titre;
    protected $chapo;
    protected $contenu;
    protected $createdAt;
    protected $updatedAt;
    protected $img;
    protected $slug;
    protected $categorie;
    protected $auteur;


    public function getAuteur()
    {
        return $this->auteur;
    }


    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }


    public function getCategorie()
    {
        return $this->categorie;
    }


    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }


    public function getSlug()
    {
        return $this->slug;
    }


    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }


    public function getImg()
    {
        return $this->img;
    }


    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }


    public function getContenu()
    {
        return $this->contenu;
    }


    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }


    public function getChapo()
    {
        return $this->chapo;
    }


    public function setChapo($chapo)
    {
        $this->chapo = $chapo;

        return $this;
    }


    public function getTitre()
    {
        return $this->titre;
    }


    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }


    public function getIdArticle()
    {
        return $this->idArticle;
    }


    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;

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


    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
