<?php

namespace App\Model;

use App\Core\Db;
use PDO;

/**
 * Articles Model file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class ArticlesModel
{
    protected string $table;
    protected $db;

    public function __construct()
    {
        $this->table = "articles";
        $this->db = Db::getInstance();
    }


    /**
     * getAllArticles function
     *
     * @return null|array|object
     */
    public function getAllArticles(): null|array|object
    {
        $sql = "SELECT articles.id_article, articles.titre, articles.chapo, articles.contenu, articles.created_at, articles.img, articles.slug, categorie.type, utilisateurs.prenom 
                FROM $this->table 
                INNER JOIN categorie ON articles.id_categorie=categorie.id_categorie 
                INNER JOIN utilisateurs ON articles.id_utilisateur=utilisateurs.id_utilisateur 
                ORDER BY articles.created_at ASC";

        $query = $this->db->query($sql);
        $data = $query->fetchAll();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }


    /**
     * getArticleBySlug function
     *
     * @param string $slug
     * 
     * @return null|array|object
     */
    public function getArticleBySlug(string $slug): null|array|object
    {
        $sql = "SELECT articles.id_article, articles.titre, articles.chapo, articles.contenu, articles.created_at, articles.img, type, prenom 
                FROM $this->table INNER JOIN categorie ON articles.id_categorie=categorie.id_categorie 
                INNER JOIN utilisateurs ON articles.id_utilisateur=utilisateurs.id_utilisateur 
                WHERE articles.slug = :slug";

        $query = $this->db->prepare($sql);

        $query->bindParam(':slug', $slug, PDO::PARAM_STR);

        $query->execute();

        $data = $query->fetch();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }


    /**
     * getArticleById function
     *
     * @param string $id
     * 
     * @return null|array|object
     */
    public function getArticleById(string $id): null|array|object
    {
        $sql = "SELECT articles.id_article, articles.titre, articles.chapo, articles.contenu, articles.created_at, articles.img, articles.slug, type, articles.id_categorie 
                FROM $this->table 
                INNER JOIN categorie ON articles.id_categorie=categorie.id_categorie 
                INNER JOIN utilisateurs ON articles.id_utilisateur=utilisateurs.id_utilisateur 
                WHERE articles.id_article = :id";

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
     * getArticlesByCategorie function
     *
     * @param string $id_categorie
     * @return null|array|object
     */
    public function getArticlesByCategorie(string $id_categorie): null|array|object
    {
        $sql = "SELECT id_article, titre, chapo, contenu, created_at, img, slug, type, prenom 
                FROM $this->table 
                INNER JOIN type ON articles.id_categorie=categorie.id_categorie 
                INNER JOIN prenom ON articles.id_utilisateur=utilisateurs.id_utilisateur 
                WHERE id_categorie = :id_categorie";

        $query = $this->db->prepare($sql);

        $query->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);

        $query->execute();

        $data = $query->fetchAll();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }


    /**
     * addArticle function
     *
     * @param string $titre
     * @param string $chapo
     * @param string $contenu
     * @param string $img
     * @param string $slug
     * @param string $id_categorie
     * @param string $id_utilisateur
     * 
     * @return void
     */
    public function addArticle(string $titre, string $chapo, string $contenu, string $img, string $slug, string $id_categorie, string $id_utilisateur): void
    {
        $sql = "INSERT INTO $this->table (titre, chapo, contenu, img, slug, id_categorie, id_utilisateur) 
                VALUES (:titre, :chapo, :contenu, :img, :slug, :id_categorie, :id_utilisateur)";

        $query = $this->db->prepare($sql);

        $query->bindParam(':titre', $titre, PDO::PARAM_STR);
        $query->bindParam(':chapo', $chapo, PDO::PARAM_STR);
        $query->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $query->bindParam(':img', $img, PDO::PARAM_STR);
        $query->bindParam(':slug', $slug, PDO::PARAM_STR);
        $query->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);
        $query->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

        $query->execute();
    }


    /**
     * updateArticle function
     *
     * @param string $id_article
     * @param string $titre
     * @param string $chapo
     * @param string $contenu
     * @param string $img
     * @param string $slug
     * @param string $id_categorie
     * 
     * @return void
     */
    public function updateArticle(string $id_article, string $titre, string $chapo, string $contenu, string $img, string $slug, string $id_categorie): void
    {
        $sql = "UPDATE $this->table 
                SET titre = :titre, chapo = :chapo, contenu = :contenu, img = :img, slug = :slug, id_categorie = :id_categorie, updated_at = CURRENT_TIMESTAMP 
                WHERE id_article = :id_article";

        $query = $this->db->prepare($sql);

        $query->bindParam(':titre', $titre, PDO::PARAM_STR);
        $query->bindParam(':chapo', $chapo, PDO::PARAM_STR);
        $query->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $query->bindParam(':img', $img, PDO::PARAM_STR);
        $query->bindParam(':slug', $slug, PDO::PARAM_STR);
        $query->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);
        $query->bindParam(':id_article', $id_article, PDO::PARAM_INT);


        $query->execute();
    }


    /**
     * deleteArticle function
     *
     * @param string $id_article
     * @return \PDOStatement
     */
    public function deleteArticle(string $id_article): \PDOStatement
    {
        $sql = "DELETE FROM $this->table WHERE id_article = :id_article";

        $query = $this->db->prepare($sql);

        $query->bindParam(':id_article', $id_article, PDO::PARAM_INT);

        $query->execute();

        return $query;
    }
}
