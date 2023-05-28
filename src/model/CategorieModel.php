<?php

namespace App\Model;

use App\Core\Db;
use App\Entity\Categorie;

/**
 * Categorie Model file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class CategorieModel
{
    protected string $table;
    protected $db;

    public function __construct()
    {
        $this->table = "categorie";
        $this->db = Db::getInstance();
    }


    /**
     * getAllCategories function
     *
     * @return array|object|null
     */
    public function getAllCategories(): array|object|null
    {
        $sql = "SELECT id_categorie, type FROM $this->table";
        $query = $this->db->query($sql);
        $data = $query->fetchAll();

        if ($data) {
            $categories = [];
            foreach($data as $datum){
                $categorie = new Categorie;
                $categorie->hydrate($datum);
                $categories[] = $categorie;
            }
            return $categories;
        } else {
            return null;
        }
    }
}
