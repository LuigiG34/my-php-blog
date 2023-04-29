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

                $alert = $this->alert('danger', $verif);
                $this->twig->addGlobal('alert', $alert);

                $form = $this->signInForm();
                
                echo $this->twig->render('utilisateurs/signin.html.twig', [
                    'alert' => $alert,
                    'form' => $form
                ]);
            } else {

                // succès mettre flash succès + créer la session + reidirection vers page accueil
                $session->setSession('user', [
                    'email' => $data->email,
                    'prenom' => $data->prenom,
                    'role' => $data->role
                ]);

                $user = $session->getSession('user');
                $alert = $this->alert('success', 'Bienvenue ' . $data->prenom . ' sur mon blog !');
                $this->twig->addGlobal('alert', $alert);
                $this->twig->addGlobal('user', $user);


                echo $this->twig->render('homepage/index.html.twig', [
                    'alert' => $alert,
                    'user' => $user
                ]);
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
            
            $form = $this->signInForm();

            $this->twig->display('utilisateurs/signin.html.twig', [
                'form' => $form
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

                $alert = $this->alert('danger', $verif);
                $this->twig->addGlobal('alert', $alert);

                $form = $this->signUpForm();
                
                echo $this->twig->render('utilisateurs/signup.html.twig', [
                    'alert' => $alert,
                    'form' => $form
                ]);

            } else {

                $email = strip_tags($post->getPost('email'));
                $prenom = strip_tags($post->getPost('prenom'));
                $pswd = password_hash(strip_tags($post->getPost('password')), PASSWORD_ARGON2I);

                $userModel->createUser($email, $pswd, $prenom);
                $alert = $this->alert('success', 'Votre inscription a bien fonctionné !');
                $form = $this->signInForm();

                echo $this->twig->render('utilisateurs/signin.html.twig', [
                    'alert' => $alert,
                    'form' => $form
                ]);
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

            $form = $this->signUpForm();

            $this->twig->display('utilisateurs/signup.html.twig', [
                'form' => $form
            ]);
        } else {
            // if user session exists no access to signin
            header('Location: /');
        }
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


    public function signInForm()
    {
        $form = new Form;

        $form->debutForm('post', '/utilisateurs/signinValid')
            ->ajoutLabelFor('email', 'Email :')
            ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true'])
            ->ajoutLabelFor('password', 'Mot de passe :')
            ->ajoutInput('password', 'password', ['class' => 'form-control mb-3', 'id' => 'password', 'required' => 'true'])
            ->ajoutBouton("Me connecter", ['class' => 'btn btn-primary w-100 mt-3'])
            ->finForm();

        return $form->create();
    }

    public function signUpForm()
    {
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

        return $form->create();
    }
}
