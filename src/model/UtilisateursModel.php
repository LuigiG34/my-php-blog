<?php

namespace App\Model;

class UtilisateursModel extends Model
{
    protected $table;

    public function __construct()
    {
        $this->table = "utilisateurs";
    }
}