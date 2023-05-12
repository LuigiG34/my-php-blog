<?php

namespace App\Model;

use App\Core\Db;

class CategorieModel
{
    protected $table;
    protected $db;

    public function __construct()
    {
        $this->table = "categorie";
        $this->db = Db::getInstance();
    }


    public function getAllCategories()
    {
        $sql = "SELECT id_categorie, type FROM $this->table";
        $query = $this->db->query($sql);
        $data = $query->fetchAll();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }
}
