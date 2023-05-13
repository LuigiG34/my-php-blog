<?php

namespace App\Validation;

use Exception;

/**
 * ImageTreatment file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class ImageTreatment
{

    /**
     * fileExists function
     *
     * @param array $file
     * 
     * @return boolean
     */
    public function fileExists(array $file): bool
    {
        if (!isset($file['name']) || empty($file['name'])) {
            return false;
        }
        return true;
    }


    /**
     * isImage function
     *
     * @param array $file
     * 
     * @return boolean
     */
    public function isImage(array $file): bool
    {
        if (!getimagesize($file["tmp_name"])) {
            return false;
        }
        return true;
    }


    /**
     * validExtension function
     *
     * @param array $file
     * 
     * @return boolean
     */
    public function validExtension(array $file): bool
    {
        // On récupère l'extension
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif") {
            return false;
        }
        return true;
    }


    /**
     * alreadyExists function
     *
     * @param array $file
     * @param string $dir
     * 
     * @return boolean
     */
    public function alreadyExists(array $file, string $dir): bool
    {
        $file['name'] = str_replace(" ", "_", $file['name']);
        $target_file = $dir . $file['name'];

        if (file_exists($target_file)) {
            return false;
        }
        return true;
    }


    /**
     * sizeValid function
     *
     * @param array $file
     * 
     * @return boolean
     */
    public function sizeValid(array $file): bool
    {
        if ($file['size'] > 1000000) {
            return false;
        }
        return true;
    }


    /**
     * moveFile function
     *
     * @param array $file
     * @param string $dir
     * 
     * @return boolean
     */
    public function moveFile(array $file, string $dir): bool
    {
        $file['name'] = str_replace(" ", "_", $file['name']);
        $target_file = $dir . $file['name'];

        if (!move_uploaded_file($file['tmp_name'], $target_file)) {
            return false;
        }
        return true;
    }


    /**
     * addFile function
     *
     * @param array $file
     * @param string $dir
     * 
     * @throws Exception
     * 
     * @return string
     */
    public function addFile(array $file, string $dir): string
    {
        try {
            if ($this->fileExists($file) === false) {
                throw new Exception("You must select an image");
            }

            if ($this->isImage($file) === false) {
                throw new Exception("Le fichier sélectionné n'est pas une image.");
            }

            if ($this->validExtension($file) === false) {
                throw new Exception("L'extension n'est pas valable.");
            }

            if ($this->alreadyExists($file, $dir) === false) {
                throw new Exception("Le fichier existe déjà.");
            }

            if ($this->sizeValid($file) === false) {
                throw new Exception("Le fichier est trop volumineux.");
            }

            if ($this->moveFile($file, $dir) === false) {
                throw new Exception("Ajouter l'image n'a pas fonctionné.");
            }

            $file['name'] = str_replace(" ", "_", $file['name']);
            return $file['name'];
        } catch (Exception $e) {

            return $e->getMessage();
            header("location: /");
        }
    }
}
