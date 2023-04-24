<?php

namespace App\Validation;
use FFI\Exception;

abstract class ImageTreatment
{
    public function fileExists($file)
    {
        if (!isset($file['name']) || empty($file['name'])){
            return false;
        }else{
            return true;
        }
    }

    public function isImage($file)
    {
        if (!getimagesize($file["tmp_name"])){
            return false;
        }else{
            return true;
        }
    }

    public function validExtension($file)
    {
        // On récupère l'extension
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif"){
            return false;
        }else{
            return true;
        }
    }


    public function alreadyExists($file, $dir)
    {
        $file['name'] = str_replace(" ", "_",$file['name']);
        $target_file = $dir . $file['name'];

        if (file_exists($target_file)){
            return false;
        }else{
            return true;
        }
    }


    public function sizeValid($file)
    {
        if ($file['size'] > 1000000){
            return false;
        }else{
            return true;
        }
    }


    public function moveFile($file, $dir)
    {
        $file['name'] = str_replace(" ", "_",$file['name']);
        $target_file = $dir . $file['name'];

        if (!move_uploaded_file($file['tmp_name'], $target_file)){
            return false;
        }else{
            return true;
        }
    }


    public function addFile($file, $dir)
    {
        try{
            if($this->fileExists($file) === false){
                throw new Exception("You must select an image");
            }

            if($this->isImage($file) === false){
                throw new Exception("Le fichier sélectionné n'est pas une image.");
            }

            if($this->validExtension($file) === false){
                throw new Exception("L'extension n'est pas valable.");
            }

            if($this->alreadyExists($file, $dir) === false){
                throw new Exception("Le fichier existe déjà.");
            }

            if($this->sizeValid($file) === false){
                throw new Exception("Le fichier est trop volumineux.");
            }

            if($this->moveFile($file, $dir) === false){
                throw new Exception("Ajouter l'image n'a pas fonctionné.");
            }

            $file['name'] = str_replace(" ", "_",$file['name']);
            return $file['name'];

        } catch (Exception $e) {
            // add message to echo with an alert() method like flash in symfony.
            header("location: /");
            exit;
        }
    }
}