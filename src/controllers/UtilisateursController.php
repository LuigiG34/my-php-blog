<?php

namespace App\Controllers;

use App\Config\Post;
use App\Config\Session;
use App\Core\Form;
use App\Model\UtilisateursModel;
use App\Validation\Validation;

/**
 * UtilisateursController
 */
class UtilisateursController extends Controller
{
    public function signinValid()
    {
        $session = new Session;

        if ($session->getSession('user') === false) {
            $post = new Post;
            $userModel = new UtilisateursModel;
            $validation = new Validation;
            $allPosts = $post->getAllPost();

            $data = $userModel->getUserByEmail($post->getPost('email'));
            $password = $data->mot_de_passe;

            $verif = $validation->signInValid($post->getPost('email'), $allPosts, $post->getPost('password'), $password, $data);

            if ($verif !== true) {

                $this->alert('danger', $verif);
                header('Location: /');        

            } else {

                // succès mettre flash succès + créer la session + reidirection vers page accueil
                $session->setSession('user', [
                    'email' => $data['email'],
                    'prenom' => $data['prenom'],
                    'role' => $data['role']
                ]);

                $this->alert('success', 'Bienvenue sur mon blog !');
                header('Location: /');
            }
        } else {
            // if user session exists no access to signin
            header('Location: /');
        }
    }

    /**
     * Login
     */
    public function signin()
    {
        $session = new Session;

        if ($session->getSession('user') === false) {
            $form = new Form;

            $form->debutForm('post', '/utilisateurs/signinValid')
                ->ajoutLabelFor('email', 'Email :')
                ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true'])
                ->ajoutLabelFor('password', 'Mot de passe :')
                ->ajoutInput('password', 'password', ['class' => 'form-control mb-3', 'id' => 'password', 'required' => 'true'])
                ->ajoutBouton("Me connecter", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            $this->twig->display('utilisateurs/signin.html.twig', [
                'form' => $form->create()
            ]);
        } else {
            // if user session exists no access to signin
            header('Location: /');
        }
    }

    public function signupValid()
    {
        $session = new Session;

        if ($session->getSession('user') === false) {
            $post = new Post;
            $userModel = new UtilisateursModel;
            $validation = new Validation;
            $allPosts = $post->getAllPost();

            $data = $userModel->getUserByEmail($post->getPost('email'));
            $verif = $validation->signUpValid($post->getPost('email'), $allPosts, $post->getPost('password'), $post->getPost('password-again'), $data);

            if ($verif !== true) {

                $this->alert('danger', $verif);
                header('Location: /');

            } else {

                $email = strip_tags($post->getPost('email'));
                $prenom = strip_tags($post->getPost('prenom'));
                $pswd = password_hash(strip_tags($post->getPost('password')), PASSWORD_ARGON2I);

                $userModel->createUser($email, $pswd, $prenom);
                $this->alert('success', 'Votre inscription a bien fonctionné !');
                header('Location: /utilisateurs/signin');
            }
        } else {
            // if user session exists no access to signup
            header('Location: /');
        }
    }

    /**
     * register
     */
    public function signup()
    {
        $session = new Session;

        if ($session->getSession('user') === false) {
            $form = new Form;

            $form->debutForm('post', '/utilisateurs/signupValid')
                ->ajoutLabelFor('prenom', 'Prénom :')
                ->ajoutInput('text', 'prenom', ['class' => 'form-control mb-3', 'id' => 'prenom', 'required' => 'true'])
                ->ajoutLabelFor('email', 'Email :')
                ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true'])
                ->ajoutLabelFor('password', 'Mot de passe :')
                ->ajoutInput('password', 'password', ['class' => 'form-control mb-3', 'id' => 'password', 'required' => 'true'])
                ->ajoutLabelFor('password', 'Confirmer mot de passe :')
                ->ajoutInput('password', 'password-again', ['class' => 'form-control mb-3', 'id' => 'password-again', 'required' => 'true'])
                ->ajoutInput('checkbox', 'rgpd', ['class' => 'me-2', 'required' => 'true'])
                ->ajoutLabelFor('rgpd', 'Accepter les termes et les conditions d\'utilisations')
                ->ajoutBouton("M'inscrire", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            $this->twig->display('utilisateurs/signup.html.twig', [
                'form' => $form->create()
            ]);
        } else {
            // if user session exists no access to signin
            header('Location: /');
        }
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
