<?php

namespace App\Model;

use App\Core\Db;
use PDO;

/**
 * Commentaire Model file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class CommentaireModel
{
    protected string $table;
    protected $db;

    public function __construct()
    {
        $this->table = "commentaires";
        $this->db = Db::getInstance();
    }


    /**
     * getCommentairesByArticleId function
     *
     * @param string $id
     * 
     * @return array|object|null
     */
    public function getCommentairesByArticleId(string $id): array|object|null
    {
        $sql = "SELECT commentaires.contenu, commentaires.created_at, utilisateurs.prenom, statut_commentaire.type 
                FROM $this->table 
                INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id_utilisateur 
                INNER JOIN statut_commentaire ON commentaires.id_statut_commentaire = statut_commentaire.id_statut_commentaire 
                WHERE commentaires.id_article = :id AND statut_commentaire.type = 'VALID'";

        $query = $this->db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $query->execute();

        $data = $query->fetchAll();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }


    /**
     * getAllCommentaires function
     *
     * @return array|object|null
     */
    public function getAllCommentaires(): array|object|null
    {
        $sql = "SELECT c.id_statut_commentaire, c.id_commentaire, c.contenu, c.created_at, utilisateurs.email, statut_commentaire.type, articles.titre
                FROM $this->table AS c 
                INNER JOIN utilisateurs ON c.id_utilisateur = utilisateurs.id_utilisateur 
                INNER JOIN articles ON c.id_article = articles.id_article
                INNER JOIN statut_commentaire ON c.id_statut_commentaire = statut_commentaire.id_statut_commentaire;";

        $query = $this->db->query($sql);

        $data = $query->fetchAll();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }


    /**
     * addCommentaire function
     *
     * @param string $contenu
     * @param string $id_u
     * @param string $id_a
     * 
     * @return void
     */
    public function addCommentaire(string $contenu, string $id_u, string $id_a): void
    {
        $sql = "INSERT INTO $this->table (contenu, id_utilisateur, id_article) VALUES (:contenu, :id_utilisateur, :id_article)";

        $query = $this->db->prepare($sql);

        $query->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $query->bindParam(':id_utilisateur', $id_u, PDO::PARAM_INT);
        $query->bindParam(':id_article', $id_a, PDO::PARAM_INT);

        $query->execute();
    }


    /**
     * getCommentaireById function
     *
     * @param string $id
     * 
     * @return array|object|null
     */
    public function getCommentaireById(string $id): array|object|null
    {
        $sql = "SELECT * FROM $this->table WHERE id_commentaire = :id";

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


    /**
     * updateStatus function
     *
     * @param string $id
     * @param string $id_statut
     * 
     * @return void
     */
    public function updateStatus(string $id, string $id_statut): void
    {
        $sql = "UPDATE $this->table SET id_statut_commentaire = :id_statut WHERE id_commentaire = :id";

        $query = $this->db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':id_statut', $id_statut, PDO::PARAM_INT);

        $query->execute();
    }
}
