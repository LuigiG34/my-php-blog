<?php

namespace App\Model;

use App\Core\Db;

class ArticlesModel
{
    protected $table;
    protected $db;

    public function __construct()
    {
        $this->table = "articles";
        $this->db = Db::getInstance();
    }

    public function getAllArticles()
    {
        $sql = "SELECT id_article, titre, chapo, contenu, created_at, img, slug, type, prenom FROM $this->table INNER JOIN type ON articles.id_categorie=categorie.id_categorie INNER JOIN prenom ON articles.id_utilisateur=utilisateurs.id_utilisateur";
        $query = $this->db->query($sql);
        $data = $query->fetchAll();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }

    public function getArticleBySlug($slug)
    {
        $sql = "SELECT id_article, titre, chapo, contenu, created_at, img, slug, type, prenom FROM $this->table INNER JOIN type ON articles.id_categorie=categorie.id_categorie INNER JOIN prenom ON articles.id_utilisateur=utilisateurs.id_utilisateur WHERE slug = :slug";
        $query = $this->db->prepare($sql);
        $query->execute([
            ":slug" => $slug
        ]);

        $data = $query->fetch();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }

    public function getArticlesByCategorie($id_categorie)
    {
        $sql = "SELECT id_article, titre, chapo, contenu, created_at, img, slug, type, prenom FROM $this->table INNER JOIN type ON articles.id_categorie=categorie.id_categorie INNER JOIN prenom ON articles.id_utilisateur=utilisateurs.id_utilisateur WHERE id_categorie = :id_categorie";
        $query = $this->db->prepare($sql);
        $query->execute([
            ":id_categorie" => $id_categorie
        ]);

        $data = $query->fetchAll();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }

    public function addArticle($titre, $chapo, $contenu, $img, $slug, $id_categorie, $id_utilisateur)
    {
        $sql = "INSERT INTO $this->table (titre, chapo, contenu, img, slug, id_categorie, id_utilisateur) VALUES (:titre, :chapo, :contenu, :img, :slug, :id_categorie, :id_utilisateur)";
        $query = $this->db->prepare($sql);
        $query->execute([
            ":titre" => $titre,
            ":chapo" => $chapo,
            ":contenu" => $contenu,
            ":img" => $img,
            ":slug" => $slug,
            ":id_categorie" => $id_categorie,
            ":id_utilisateur" => $id_utilisateur
        ]);
    }

    public function updateArticle($id_article, $titre, $chapo, $contenu, $img, $slug, $id_categorie)
    {
        $sql = "UPDATE $this->table SET titre = :titre, chapo = :chapo, contenu = :contenu, img = :img, slug = :slug, id_categorie = :id_categorie, updated_at = CURRENT_TIMESTAMP WHERE id_article = :id_article";
        $query = $this->db->prepare($sql);
        $query->execute([
            ":titre" => $titre,
            ":chapo" => $chapo,
            ":contenu" => $contenu,
            ":img" => $img,
            ":slug" => $slug,
            ":id_categorie" => $id_categorie,
            ":id_article" => $id_article
        ]);
    }

    public function deleteArticle($id_article)
    {
        $sql = "DELETE FROM $this->table WHERE id_article = :id_article";
        $query = $this->db->prepare($sql);
        $query->execute([
            ":id_article" => $id_article
        ]);

        return $query;
    }
}