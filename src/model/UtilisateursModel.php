<?php

namespace App\Model;

use App\Core\Db;
use PDO;

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
        $sql = "INSERT INTO $this->table (prenom, email, mot_de_passe) 
                VALUES (:prenom, :email, :mot_de_passe)";

        $query = $this->db->prepare($sql);

        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mot_de_passe', $password, PDO::PARAM_STR);

        $query->execute();
    }


    public function getUserByEmail($email)
    {
        $sql = "SELECT id_utilisateur, prenom, email, mot_de_passe, is_actif, role 
                FROM $this->table INNER JOIN role ON utilisateurs.id_role=role.id_role 
                WHERE email = :email";

        $query = $this->db->prepare($sql);

        $query->bindParam(':email', $email, PDO::PARAM_STR);

        $query->execute();

        $data = $query->fetch();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }


    public function getUserById($id)
    {
        $sql = "SELECT id_utilisateur, prenom, email, mot_de_passe, is_actif, role, created_at 
                FROM $this->table 
                INNER JOIN role ON utilisateurs.id_role=role.id_role 
                WHERE id_utilisateur = :id";

        $query = $this->db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $query->execute();

        $data = $query->fetch();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }


    public function getAllUsers()
    {
        $sql = "SELECT id_utilisateur, prenom, email, mot_de_passe, is_actif, role, created_at 
                FROM $this->table 
                INNER JOIN role ON utilisateurs.id_role=role.id_role";

        $query = $this->db->query($sql);

        $data = $query->fetchAll();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }


    public function updateUserById($id, $prenom, $email, $mot_de_passe)
    {
        $sql = "UPDATE $this->table 
                SET prenom = :prenom, email = :email, mot_de_passe = :mot_de_passe 
                WHERE id_utilisateur = :id";

        $query = $this->db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);

        $query->execute();
    }


    public function updateToken($token_reset, $email)
    {
        $sql = "UPDATE $this->table SET token_reset = :token_reset WHERE email = :email";

        $query = $this->db->prepare($sql);

        $query->bindParam(':token_reset', $token_reset, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);

        $query->execute();
    }


    public function updateTokenAndPasswordByToken($password, $token_reset, $token_reset_db)
    {
        $sql = "UPDATE $this->table SET token_reset = :token_reset, mot_de_passe = :mot_de_passe WHERE token_reset = :token_reset_db";

        $query = $this->db->prepare($sql);

        $query->bindParam(':mot_de_passe', $password, PDO::PARAM_STR);
        $query->bindParam(':token_reset_db', $token_reset_db, PDO::PARAM_STR);
        $query->bindParam(':token_reset', $token_reset, PDO::PARAM_STR);

        $query->execute();
    }


    public function getUserByToken($token_reset)
    {
        $sql = "SELECT * FROM $this->table INNER JOIN role ON utilisateurs.id_role=role.id_role WHERE token_reset = :token_reset";

        $query = $this->db->prepare($sql);

        $query->bindParam(':token_reset', $token_reset, PDO::PARAM_STR);

        $query->execute();

        $data = $query->fetch();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }

    public function updateActif($id, $is_actif)
    {
        $sql = "UPDATE $this->table SET is_actif = :is_actif WHERE id_utilisateur = :id";

        $query = $this->db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':is_actif', $is_actif, PDO::PARAM_INT);

        $query->execute();
    }
}
