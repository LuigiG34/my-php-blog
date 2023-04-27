<?php

namespace App\Controllers;

use App\Config\Session;
use App\Core\Form;

/**
 * UtilisateursController
 */
class UtilisateursController extends Controller
{
    /**
     * Login
     */
    public function signin()
    {
        $form = new Form;

        $form->debutForm()
        ->ajoutLabelFor('email', 'Email :')
        ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true'])
        ->ajoutLabelFor('password', 'Mot de passe :')
        ->ajoutInput('password', 'password', ['class' => 'form-control mb-3', 'id' => 'password', 'required' => 'true'])
        ->ajoutBouton("Me connecter", ['class' => 'btn btn-primary w-100 mt-3'])
        ->finForm();

        $this->twig->display('utilisateurs/signin.html.twig', [
            'form' => $form->create()
        ]);
    }


    /**
     * register
     */
    public function signup()
    {
        $form = new Form;

        $form->debutForm()
        ->ajoutLabelFor('prenom', 'Prénom :')
        ->ajoutInput('text', 'prenom', ['class' => 'form-control mb-3', 'id' => 'prenom', 'required' => 'true'])
        ->ajoutLabelFor('email', 'Email :')
        ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true'])
        ->ajoutLabelFor('password', 'Mot de passe :')
        ->ajoutInput('password', 'password', ['class' => 'form-control mb-3', 'id' => 'password', 'required' => 'true'])
        ->ajoutLabelFor('password', 'Confirmer mot de passe :')
        ->ajoutInput('password', 'password-again', ['class' => 'form-control mb-3', 'id' => 'password-again', 'required' => 'true'])
        ->ajoutInput('checkbox', 'rgpd',['class' => 'me-2', 'required' => 'true'])
        ->ajoutLabelFor('rgpd', 'Accepter les termes et les conditions d\'utilisations' )
        ->ajoutBouton("M'inscrire", ['class' => 'btn btn-primary w-100 mt-3'])
        ->finForm();

        $this->twig->display('utilisateurs/signup.html.twig', [
            'form' => $form->create()
        ]);
    }


    /**
     * reset password
     */
    public function resetPassword()
    {
        $form = new Form;

        $this->twig->display('utilisateurs/reset-password.html.twig');
    }


    /**
     * new password
     */
    public function newPassword()
    {
        $form = new Form;
        
        $this->twig->display('utilisateurs/new-password.html.twig');
    }


    /**
     * Deconexion      
     */
    public function logout()
    {
        $session = new Session;
        $session->unsetSession('user');
        header('Location: /');
        exit;
    }
}