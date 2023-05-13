<?php

namespace App\Model;

use App\Core\Db;
use PDO;

class CommentaireModel
{
    protected $table;
    protected $db;

    public function __construct()
    {
        $this->table = "commentaires";
        $this->db = Db::getInstance();
    }


    public function getCommentairesByArticleId($id)
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


    public function getAllCommentaires()
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


    public function addCommentaire($contenu, $id_u, $id_a)
    {
        $sql = "INSERT INTO $this->table (contenu, id_utilisateur, id_article) VALUES (:contenu, :id_utilisateur, :id_article)";

        $query = $this->db->prepare($sql);

        $query->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $query->bindParam(':id_utilisateur', $id_u, PDO::PARAM_INT);
        $query->bindParam(':id_article', $id_a, PDO::PARAM_INT);

        $query->execute();
    }


    public function getCommentaireById($id)
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


    public function updateStatus($id, $id_statut)
    {
        $sql = "UPDATE $this->table SET id_statut_commentaire = :id_statut WHERE id_commentaire = :id";

        $query = $this->db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':id_statut', $id_statut, PDO::PARAM_INT);

        $query->execute();
    }
}
