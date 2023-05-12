<?php

namespace App\Entity;

class StatutCommentaire
{
    protected $idStatutCommentaire;
    protected $type;


    public function getType()
    {
        return $this->type;
    }


    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }


    public function getIdStatutCommentaire()
    {
        return $this->idStatutCommentaire;
    }


    public function setIdStatutCommentaire($idStatutCommentaire)
    {
        $this->idStatutCommentaire = $idStatutCommentaire;

        return $this;
    }
}
