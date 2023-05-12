<?php

namespace App\Entity;

class Role
{
    protected $idRole;
    protected $role;


    public function getRole()
    {
        return $this->role;
    }


    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }


    public function getIdRole()
    {
        return $this->idRole;
    }


    public function setIdRole($idRole)
    {
        $this->idRole = $idRole;

        return $this;
    }
}
