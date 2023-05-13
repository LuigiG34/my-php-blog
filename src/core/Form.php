<?php

namespace App\Core;


class Form
{
    protected $formCode = '';


    public function create()
    {
        return $this->formCode;
    }


    private function ajoutAttribut(array $attributs)
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


    public function debutForm(string $method = 'post', string $action = '#', array $attributs = [])
    {
        // On crée la balise form.
        $this->formCode .= "<form action='$action' method='$method'";

        // On ajoute les attributs éventuels.
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) . '>' : '>';

        return $this;
    }


    public function finForm()
    {
        $this->formCode .= "</form>";

        return $this;
    }


    public function ajoutLabelFor(string $for, string $texte, array $attributs = [])
    {
        // On ouvre la balise.
        $this->formCode .= "<label for'$for'";

        // On ajoute les attributs.
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) : '';

        // On ajoute le texte.
        $this->formCode .= ">$texte</label>";

        return $this;
    }

    public function ajoutInput(string $type, string $nom, array $attributs = [])
    {
        // On ouvre la balise.
        $this->formCode .= "<input type='$type' name='$nom'";

        // On ajoute les attributs.
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) . '>' : '>';

        return $this;
    }


    public function ajoutTextarea(string $nom, string $valeur = '', array $attributs = [])
    {
        // On ouvre la balise.
        $this->formCode .= "<textarea name='$nom'";

        // On ajoute les attributs.
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) : '';

        // On ajoute le texte.
        $this->formCode .= ">$valeur</textarea>";

        return $this;
    }


    public function ajoutSelect(string $nom, array $options, array $attributs = [], $default = null)
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


    public function ajoutBouton(string $texte, array $attributs = [])
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
