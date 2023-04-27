<?php

namespace App\Controllers;

use App\Core\Form;

/**
 * ContactController
 */
class ContactController extends Controller
{
    /**
     * Appelle contact
     */
    public function index()
    {
        $form = new Form;

        $form->debutForm()
        ->ajoutLabelFor('prenom', 'Prénom :')
        ->ajoutInput('text', 'prenom', ['class' => 'form-control mb-3', 'id' => 'prenom', 'required' => 'true'])
        ->ajoutLabelFor('nom', 'Nom :')
        ->ajoutInput('text', 'nom', ['class' => 'form-control mb-3', 'id' => 'nom', 'required' => 'true'])
        ->ajoutLabelFor('email', 'Email :')
        ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true'])
        ->ajoutLabelFor('message', 'Message :')
        ->ajoutTextarea('message', '', ['class' => 'form-control mb-3', 'id' => 'message', 'rows' => 5, 'required' => 'true'])

        ->ajoutBouton("M'inscrire", ['class' => 'btn btn-primary w-100 mt-3'])
        ->finForm();

        $this->twig->display('contact/index.html.twig', [
            'form' => $form->create()
        ]);
    }
}