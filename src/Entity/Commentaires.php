<?php

namespace App\Entity;

class Commentaires
{
    protected $id_commentaire;
    protected $contenu;
    protected $created_at;
    protected $id_article;
    protected $article;
    protected $auteur;
    protected $statut;
    protected $id_admin;
    protected $id_statut_commentaire;


    /**
     * Get the value of id_admin
     */ 
    public function getId_admin()
    {
        return $this->id_admin;
    }

    /**
     * Set the value of id_admin
     *
     * @return  self
     */ 
    public function setId_admin($id_admin)
    {
        $this->id_admin = $id_admin;

        return $this;
    }

    /**
     * Get the value of id_article
     */ 
    public function getId_article()
    {
        return $this->id_article;
    }

    /**
     * Set the value of id_article
     *
     * @return  self
     */ 
    public function setId_article($id_article)
    {
        $this->id_article = $id_article;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of contenu
     */ 
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     *
     * @return  self
     */ 
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get the value of id_commentaire
     */ 
    public function getId_commentaire()
    {
        return $this->id_commentaire;
    }

    /**
     * Set the value of id_commentaire
     *
     * @return  self
     */ 
    public function setId_commentaire($id_commentaire)
    {
        $this->id_commentaire = $id_commentaire;

        return $this;
    }

    /**
     * Get the value of auteur
     */ 
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set the value of auteur
     *
     * @return  self
     */ 
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get the value of article
     */ 
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set the value of article
     *
     * @return  self
     */ 
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get the value of id_statut_commentaire
     */ 
    public function getId_statut_commentaire()
    {
        return $this->id_statut_commentaire;
    }

    /**
     * Set the value of id_statut_commentaire
     *
     * @return  self
     */ 
    public function setId_statut_commentaire($id_statut_commentaire)
    {
        $this->id_statut_commentaire = $id_statut_commentaire;

        return $this;
    }
}