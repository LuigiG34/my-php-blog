<?php

namespace App\Model;

use App\Core\Db;

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
        $sql = "SELECT commentaires.contenu, commentaires.created_at, utilisateurs.prenom, statut_commentaire.type FROM $this->table INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id_utilisateur INNER JOIN statut_commentaire ON commentaires.id_statut_commentaire = statut_commentaire.id_statut_commentaire WHERE commentaires.id_article = :id AND statut_commentaire.type = 'VALID'";

        $query = $this->db->prepare($sql);

        $query->execute([
            ":id" => $id
        ]);

        $data = $query->fetchAll();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }


    public function gettAllCommentaires()
    {
        $sql = "SELECT table.contenu, table.created_at, utilisateur.prenom, statut_commentaire.type 
        FROM $this->table AS table 
        INNER JOIN utilisateur ON table.id_utilisateur = utilisateur.id_utilisateur 
        INNER JOIN statut_commentaire ON table.id_statut_commentaire = statut_commentaire.id_statut_commentaire;";

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
        $query->execute([
            ":contenu" => $contenu,
            ":id_utilisateur" => $id_u,
            ":id_article" => $id_a
        ]);
    }

}