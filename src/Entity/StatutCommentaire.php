<?php

namespace App\Entity;

class StatutCommentaire
{
    protected $id_statut_commentaire;
    protected $type;

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

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