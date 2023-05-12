<?php

namespace App\Entity;

class Commentaires
{
    protected $idCommentaire;
    protected $contenu;
    protected $createdAt;
    protected $idArticle;
    protected $article;
    protected $auteur;
    protected $statut;
    protected $idAdmin;
    protected $idStatutCommentaire;


    public function getIdStatutCommentaire()
    {
        return $this->idStatutCommentaire;
    }


    public function setIdStatutCommentaire($idStatutCommentaire)
    {
        $this->idStatutCommentaire = $idStatutCommentaire;

        return $this;
    }


    public function getIdAdmin()
    {
        return $this->idAdmin;
    }


    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }


    public function getStatut()
    {
        return $this->statut;
    }


    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }


    public function getAuteur()
    {
        return $this->auteur;
    }


    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }


    public function getArticle()
    {
        return $this->article;
    }


    public function setArticle($article)
    {
        $this->article = $article;

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


    public function getContenu()
    {
        return $this->contenu;
    }


    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }


    public function getIdCommentaire()
    {
        return $this->idCommentaire;
    }


    public function setIdCommentaire($idCommentaire)
    {
        $this->idCommentaire = $idCommentaire;

        return $this;
    }
}
