<?php

namespace App\Model;

use App\Core\Db;
use App\Entity\Utilisateur;
use PDO;

/**
 * Utilisateur Model file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class UtilisateurModel
{
    protected string $table;
    protected $db;

    public function __construct()
    {
        $this->table = "utilisateurs";
        $this->db = Db::getInstance();
    }


    /**
     * createUser function
     *
     * @param string $email
     * @param string $password
     * @param string $prenom
     * 
     * @return void
     */
    public function createUser(string $email, string $password, string $prenom): void
    {
        $sql = "INSERT INTO $this->table (prenom, email, mot_de_passe, verif_token) 
                VALUES (:prenom, :email, :mot_de_passe, :verif_token)";

        $query = $this->db->prepare($sql);

        $token = bin2hex(random_bytes(32));
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mot_de_passe', $password, PDO::PARAM_STR);
        $query->bindParam(':verif_token', $token, PDO::PARAM_STR);

        $query->execute();
    }


    /**
     * getUserByEmail function
     *
     * @param string $email
     * 
     * @return array|object|null
     */
    public function getUserByEmail(string $email): array|object|null
    {
        $sql = "SELECT id_utilisateur, prenom, email, mot_de_passe, is_actif, token_reset, verif_token, role 
                FROM $this->table INNER JOIN role ON utilisateurs.id_role=role.id_role 
                WHERE email = :email";

        $query = $this->db->prepare($sql);

        $query->bindParam(':email', $email, PDO::PARAM_STR);

        $query->execute();

        $data = $query->fetch();

        if ($data) {
            $user = new Utilisateur;
            $user->hydrate($data);
            
            return $user;
        } else {
            return null;
        }
    }


    /**
     * getUserById function
     *
     * @param string $id
     * 
     * @return array|object|null
     */
    public function getUserById(string $id): array|object|null
    {
        $sql = "SELECT id_utilisateur, prenom, email, mot_de_passe, is_actif, role, verif_token, created_at 
                FROM $this->table 
                INNER JOIN role ON utilisateurs.id_role=role.id_role 
                WHERE id_utilisateur = :id";

        $query = $this->db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $query->execute();

        $data = $query->fetch();

        if ($data) {
            $user = new Utilisateur;
            $user->hydrate($data);
            
            return $user;
        } else {
            return null;
        }
    }


    /**
     * getAllUsers function
     *
     * @return array|object|null
     */
    public function getAllUsers(): array|object|null
    {
        $sql = "SELECT id_utilisateur, prenom, email, mot_de_passe, is_actif, role, verif_token, created_at 
                FROM $this->table 
                INNER JOIN role ON utilisateurs.id_role=role.id_role";

        $query = $this->db->query($sql);

        $data = $query->fetchAll();

        if ($data) {
            $users = [];
            foreach($data as $datum){
                $user = new Utilisateur;
                $user->hydrate($datum);
                $users[] = $user;
            }
            return $users;
        } else {
            return null;
        }
    }


    /**
     * updateUserById function
     *
     * @param string $id
     * @param string $prenom
     * @param string $email
     * @param string $mot_de_passe
     * 
     * @return void
     */
    public function updateUserById(string $id, string $prenom, string $email, string $mot_de_passe): void
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


    /**
     * updateToken function
     *
     * @param string $token_reset
     * @param string $email
     * 
     * @return void
     */
    public function updateToken(string $token_reset, string $email): void
    {
        $sql = "UPDATE $this->table SET token_reset = :token_reset WHERE email = :email";

        $query = $this->db->prepare($sql);

        $query->bindParam(':token_reset', $token_reset, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);

        $query->execute();
    }


    /**
     * updateTokenAndPasswordByToken function
     *
     * @param string $password
     * @param string $token_reset
     * @param string $token_reset_db
     * 
     * @return void
     */
    public function updateTokenAndPasswordByToken(string $password, string $token_reset, string $token_reset_db): void
    {
        $sql = "UPDATE $this->table SET token_reset = :token_reset, mot_de_passe = :mot_de_passe WHERE token_reset = :token_reset_db";

        $query = $this->db->prepare($sql);

        $query->bindParam(':mot_de_passe', $password, PDO::PARAM_STR);
        $query->bindParam(':token_reset_db', $token_reset_db, PDO::PARAM_STR);
        $query->bindParam(':token_reset', $token_reset, PDO::PARAM_STR);

        $query->execute();
    }


    /**
     * getUserByToken function
     *
     * @param string $token_reset
     * 
     * @return null|array|object
     */
    public function getUserByToken(string $token_reset): null|array|object
    {
        $sql = "SELECT * FROM $this->table INNER JOIN role ON utilisateurs.id_role=role.id_role WHERE token_reset = :token_reset";

        $query = $this->db->prepare($sql);

        $query->bindParam(':token_reset', $token_reset, PDO::PARAM_STR);

        $query->execute();

        $data = $query->fetch();

        if ($data) {
            $user = new Utilisateur;
            $user->hydrate($data);
            
            return $user;
        } else {
            return null;
        }
    }


    /**
     * getUserByVerifToken function
     *
     * @param string $verif_token
     * @return null|array|object
     */
    public function getUserByVerifToken(string $verif_token): null|array|object
    {
        $sql = "SELECT * FROM $this->table INNER JOIN role ON utilisateurs.id_role=role.id_role WHERE verif_token = :verif_token";

        $query = $this->db->prepare($sql);

        $query->bindParam(':verif_token', $verif_token, PDO::PARAM_STR);

        $query->execute();

        $data = $query->fetch();

        if ($data) {
            $user = new Utilisateur;
            $user->hydrate($data);

            return $user;
        } else {
            return null;
        }
    }


    /**
     * updateVerifToken function
     *
     * @param string $id
     * @return void
     */
    public function updateVerifToken(string $id_utilisateur): void
    {
        $sql = "UPDATE $this->table SET verif_token = :verif_token WHERE id_utilisateur = :id_utilisateur";

        $query = $this->db->prepare($sql);

        $verified = "VERIFIED";
        $query->bindParam(':verif_token', $verified, PDO::PARAM_STR);
        $query->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

        $query->execute();
    }


    /**
     * updateActif function
     *
     * @param string $id
     * @param integer $is_actif
     * 
     * @return void
     */
    public function updateActif(string $id, int $is_actif): void
    {
        $sql = "UPDATE $this->table SET is_actif = :is_actif WHERE id_utilisateur = :id";

        $query = $this->db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':is_actif', $is_actif, PDO::PARAM_INT);

        $query->execute();
    }
}
