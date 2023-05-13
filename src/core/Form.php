<?php

namespace App\Core;


/**
 * Form file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Form
{
    protected string $formCode = '';


    /**
     * create function
     *
     * @return string
     */
    public function create(): string
    {
        return $this->formCode;
    }


    /**
     * ajoutAttribut function
     *
     * @param array $attributs
     * 
     * @return string
     */
    private function ajoutAttribut(array $attributs): string
    {
        // On initialise une chaine de caracteres.
        $str = '';

        // On liste les attributs "courts".
        $courts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        // On boucle sur le tableau d'attributs.
        foreach ($attributs as $attribut => $valeur) {
            // Si l'attribut est dans la liste des attributs courts.
            if (in_array($attribut, $courts) && $valeur === true) {
                $str .= " $attribut";
            } else {
                // On ajoute attribut='valeur'.
                $str .= " $attribut=\"$valeur\"";
            }
        }

        return $str;
    }


    /**
     * debutForm function
     *
     * @param string $method
     * @param string $action
     * @param array $attributs
     * 
     * @return self
     */
    public function debutForm(string $method = 'post', string $action = '#', array $attributs = []): self
    {
        // On crée la balise form.
        $this->formCode .= "<form action='$action' method='$method'";

        // On ajoute les attributs éventuels.
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) . '>' : '>';

        return $this;
    }


    /**
     * finForm function
     *
     * @return self
     */
    public function finForm(): self
    {
        $this->formCode .= "</form>";

        return $this;
    }


    /**
     * ajoutLabelFor function
     *
     * @param string $for
     * @param string $texte
     * @param array $attributs
     * 
     * @return self
     */
    public function ajoutLabelFor(string $for, string $texte, array $attributs = []): self
    {
        // On ouvre la balise.
        $this->formCode .= "<label for'$for'";

        // On ajoute les attributs.
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) : '';

        // On ajoute le texte.
        $this->formCode .= ">$texte</label>";

        return $this;
    }


    /**
     * ajoutInput function
     *
     * @param string $type
     * @param string $nom
     * @param array $attributs
     * 
     * @return self
     */
    public function ajoutInput(string $type, string $nom, array $attributs = []): self
    {
        // On ouvre la balise.
        $this->formCode .= "<input type='$type' name='$nom'";

        // On ajoute les attributs.
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) . '>' : '>';

        return $this;
    }


    /**
     * ajoutTextarea function
     *
     * @param string $nom
     * @param string $valeur
     * @param array $attributs
     * 
     * @return self
     */
    public function ajoutTextarea(string $nom, string $valeur = '', array $attributs = []): self
    {
        // On ouvre la balise.
        $this->formCode .= "<textarea name='$nom'";

        // On ajoute les attributs.
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) : '';

        // On ajoute le texte.
        $this->formCode .= ">$valeur</textarea>";

        return $this;
    }


    /**
     * ajoutSelect function
     *
     * @param string $nom
     * @param array $options
     * @param array $attributs
     * @param array|null $default
     * 
     * @return self
     */
    public function ajoutSelect(string $nom, array $options, array $attributs = [], array $default = null): self
    {
        // On crée le select.
        $this->formCode .= "<select name='$nom'";

        // On ajoute les attributs.
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) . '>' : '>';

        // On ajoute les options.
        foreach ($options as $valeur => $texte) {
            $this->formCode .= "<option value=\"$valeur\">$texte</option>";
        }

        if ($default !== null) {
            $this->formCode .= "<option value=\"{$default[0]}\" selected>{$default[1]}</option>";
        }

        // On ferme le select.
        $this->formCode .= '</select>';

        return $this;
    }


    /**
     * ajoutBouton function
     *
     * @param string $texte
     * @param array $attributs
     * 
     * @return self
     */
    public function ajoutBouton(string $texte, array $attributs = []): self
    {
        // On ouvre le bouton.
        $this->formCode .= '<button ';

        // On ajoute les attributs.
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) : '';

        // On ajoute le texte et on ferme.
        $this->formCode .= ">$texte</button>";

        return $this;
    }
}
