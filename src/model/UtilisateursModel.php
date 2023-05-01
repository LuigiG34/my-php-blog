<?php

namespace App\Model;

use App\Core\Db;

class UtilisateursModel
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

    public function getUserByEmail($email)
    {
        $sql = "SELECT id_utilisateur, prenom, email, mot_de_passe, role FROM $this->table INNER JOIN role ON utilisateurs.id_role=role.id_role WHERE email = :email";
        $query = $this->db->prepare($sql);
        $query->execute([
            ":email" => $email
        ]);

        $data = $query->fetch();

        if($data){
            return $data;
        }else{
            return null;
        }
    }


    public function updateToken($token_reset, $email)
    {
        $sql = "UPDATE $this->table SET token_reset = :token_reset WHERE email = :email";
        $query = $this->db->prepare($sql);

        $query->execute([
            ":token_reset" => $token_reset,
            ":email" => $email
        ]);
    }

    public function updateTokenAndPasswordByToken($password, $token_reset, $token_reset_db)
    {
        $sql = "UPDATE $this->table SET token_reset = :token_reset, mot_de_passe = :mot_de_passe WHERE token_reset = :token_reset_db";
        $query = $this->db->prepare($sql);

        $query->execute([
            ":mot_de_passe" => $password,
            ":token_reset_db" => $token_reset_db,
            ":token_reset" => $token_reset
        ]);
    }


    public function getUserByToken($token_reset)
    {
        $sql = "SELECT * FROM $this->table INNER JOIN role ON utilisateurs.id_role=role.id_role WHERE token_reset = :token_reset";
        $query = $this->db->prepare($sql);
        $query->execute([
            ":token_reset" => $token_reset
        ]);

        $data = $query->fetch();

        if($data){
            return $data;
        }else{
            return null;
        }
    }
}