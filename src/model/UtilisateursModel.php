<?php

namespace App\Model;

use App\Core\Db;

class UtilisateursModel extends Model
{
    protected $table;
    protected $db;

    public function __construct()
    {
        $this->table = "utilisateurs";
        $this->db = Db::getInstance();
    }

    public function createUser($email, $password, $prenom)
    {
        $sql = "INSERT INTO $this->table (prenom, email, mot_de_passe) VALUES (:prenom, :email, :mot_de_passe)";
        $query = $this->db->prepare($sql);
        $query->execute([
            ":prenom" => $prenom,
            ":email" => $email,
            ":mot_de_passe" => $password
        ]);
    }
}