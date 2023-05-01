<?php

namespace App\Controllers;

use App\Config\Post;
use App\Config\Session;
use App\Core\Form;
use App\Model\UtilisateursModel;
use App\Validation\Validation;
use App\Core\Mailer;

/**
 * UtilisateursController
 */
class UtilisateursController extends Controller
{


    public function signInValid()
    {
        $session = new Session;

        if ($session->getSession('user') === null) {

            $post = new Post;
            $userModel = new UtilisateursModel;
            $validation = new Validation;
            $allPosts = $post->getAllPost();

            $data = $userModel->getUserByEmail($post->getPost('email'));
            $password = $data->mot_de_passe;

            $verif = $validation->signInValid($post->getPost('email'), $allPosts, $post->getPost('password'), $password, $data);

            if ($verif !== true) {

                $this->alert('danger', $verif);
                header('Location: /utilisateurs/signin');
            } else {

                $_SESSION['user'] = [
                    'id' => $data->id_utilisateur,
                    'email' => $data->email,
                    'prenom' => $data->prenom,
                    'role' => $data->role
                ];

                $this->alert('success', 'Bienvenue ' . $data->prenom . ' sur mon blog !');
                header('Location: /');
            }
        } else {
            // si utilisateur est connecté on le redirige
            header('Location: /');
        }
    }


    public function signin()
    {
        $session = new Session;

        // si utilisateur est connecté on le redirige
        if ($session->getSession('user') === null) {

            // On créer le formulaire
            $form = new Form;

            $form->debutForm('post', '/utilisateurs/signinValid')
                ->ajoutLabelFor('email', 'Email :')
                ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true'])
                ->ajoutLabelFor('password', 'Mot de passe :')
                ->ajoutInput('password', 'password', ['class' => 'form-control mb-3', 'id' => 'password', 'required' => 'true'])
                ->ajoutBouton("Me connecter", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            $this->render('utilisateurs/signin', [
                'form' => $form->create()
            ]);
        } else {
            // si utilisateur est connecté on le redirige
            header('Location: /');
        }
    }


    public function signupValid()
    {
        $session = new Session;

        if ($session->getSession('user') === null) {
            $post = new Post;
            $userModel = new UtilisateursModel;
            $validation = new Validation;
            $allPosts = $post->getAllPost();

            $data = $userModel->getUserByEmail($post->getPost('email'));

            $verif = $validation->signUpValid($post->getPost('email'), $allPosts, $post->getPost('password'), $post->getPost('password-again'), $data);

            if ($verif !== true) {

                $this->alert('danger', $verif);
                header('Location: /utilisateurs/signup');
            } else {

                $mailer = new Mailer;

                $email = strip_tags($post->getPost('email'));
                $prenom = strip_tags($post->getPost('prenom'));
                $pswd = password_hash(strip_tags($post->getPost('password')), PASSWORD_ARGON2I);

                $userModel->createUser($email, $pswd, $prenom);
                $alert = $this->alert('success', 'Votre inscription a bien fonctionné !');

                $mailer->sendConfirmationSignUp($email);

                header('Location: /utilisateurs/signin');
            }
        } else {
            // if user session exists no access to signup
            header('Location: /');
        }
    }


    public function signup()
    {
        $session = new Session;

        // si utilisateur est connecté on le redirige
        if ($session->getSession('user') === null) {

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

            $this->render('utilisateurs/signup', [
                'form' => $form->create()
            ]);
        } else {
            // si utilisateur est connecté on le redirige
            header('Location: /');
        }
    }


    public function forgotPassword()
    {
        $session = new Session;

        // si utilisateur est connecté on le redirige
        if ($session->getSession('user') === null) {

            $form = new Form;

            $form->debutForm('post', '/utilisateurs/forgotPasswordValidation')
                ->ajoutLabelFor('email', 'Email :')
                ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true'])
                ->ajoutBouton("Soumettre", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            $this->render('utilisateurs/forgot-password', [
                'form' => $form->create()
            ]);
        } else {
            // si utilisateur est connecté on le redirige
            header('Location: /');
        }
    }


    public function forgotPasswordValidation()
    {
        $session = new Session;

        // si utilisateur est connecté on le redirige
        if ($session->getSession('user') === null) {

            $validation = new Validation;
            $post = new Post;
            $userModel = new UtilisateursModel;
            $data = $userModel->getUserByEmail($post->getPost('email'));
            $allPosts = $post->getAllPost();

            $verif = $validation->forgotPassValid($post->getPost('email'), $allPosts, $data);

            if($verif !== true){

                $this->alert('danger', $verif);
                header('Location: /utilisateurs/forgotPassword');
            
            }else{

                $token = bin2hex(random_bytes(32));
                $email = htmlspecialchars($post->getPost('email'));

                $userModel->updateToken($token, $email);
                $mailer = new Mailer;
                $mailer->resetPassword($email, "http://localhost:8000/utilisateurs/newPassword/$token");

                $this->alert('success', 'Un mail vient de vous être envoyé. (Vérifié vos spams)');
                header("Location: /utilisateurs/forgotPassword");
            }


        } else {
            // si utilisateur est connecté on le redirige
            header('Location: /');
        }
    }


    public function newPassword($token)
    {
        $session = new Session;

        // si utilisateur est connecté on le redirige
        if ($session->getSession('user') === null) {

            $userModel = new UtilisateursModel;
            $data = $userModel->getUserByToken($token);

            if($data === null){
                $this->alert('danger', 'Vous n\'avez pas accès à cette page.');
                header("Location: /");
            }

            $form = new Form;

            $form->debutForm('post', "/utilisateurs/newPasswordValidation/$token")
                ->ajoutLabelFor('password', 'Mot de passe :')
                ->ajoutInput('password', 'password', ['class' => 'form-control mb-3', 'id' => 'password', 'required' => 'true'])
                ->ajoutBouton("Soumettre", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            $this->render('utilisateurs/new-password', [
                'form' => $form->create()
            ]);
            

        } else {
            // si utilisateur est connecté on le redirige
            header('Location: /');
        }
    }


    public function newPasswordValidation($token)
    {
        $session = new Session;

        // si utilisateur est connecté on le redirige
        if ($session->getSession('user') === null) {

            $validation = new Validation;
            $post = new Post;
            $userModel = new UtilisateursModel;
            $allPosts = $post->getAllPost();

            $verif = $validation->newPassValid($post->getPost('password'), $allPosts);

            if($verif !== true){

                $this->alert('danger', $verif);
                header('Location: /utilisateurs/forgotPassword');
            
            }else{

                $pswd = password_hash(strip_tags($post->getPost('password')), PASSWORD_ARGON2I);

                $userModel->updateTokenAndPasswordByToken($pswd ,'NULL', $token);

                $this->alert('success', 'Votre mot de passe a été mis à jour.');
                header("Location: /utilisateurs/signin");
            }
            

        } else {
            // si utilisateur est connecté on le redirige
            header('Location: /');
        }
    }


    /**
     * Deconexion      
     */
    public function logout()
    {
        session_start(); // start the session if it hasn't been started already

        session_unset(); // unset all session variables

        session_destroy(); // destroy the session
        header('Location: /');
        exit;
    }
}
