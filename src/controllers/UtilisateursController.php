<?php

namespace App\Controllers;

use App\Config\Post;
use App\Config\Session;
use App\Core\Form;
use App\Model\UtilisateursModel;
use App\Validation\Validation;
use App\Core\Mailer;
use App\Entity\Utilisateurs;


class UtilisateursController extends Controller
{

    protected $post;
    protected $allPosts;
    protected $session;
    protected $userSession;
    protected $form;
    protected $userModel;
    protected $validation;
    protected $mailer;


    public function __construct()
    {
        $this->post = new Post;
        $this->allPosts = $this->post->getAllPost();
        $this->session = new Session;
        $this->userSession = $this->session->getSession('user');
        $this->form = new Form;
        $this->userModel = new UtilisateursModel;
        $this->validation = new Validation;
        $this->mailer = new Mailer;
    }


    public function profil()
    {
        if ($this->userSession !== null) {

            $data = $this->userModel->getUserById($_SESSION['user']['id']);

            $user = new Utilisateurs;
            $user->setIdUtilisateur($data->id_utilisateur)
                ->setPrenom($data->prenom)
                ->setEmail($data->email)
                ->setMotDePasse($data->mot_de_passe)
                ->setRole($data->role)
                ->setCreatedAt($data->created_at);

            return $this->render('utilisateurs/index', [
                'user' => $user
            ]);
        }

        $this->alert('danger', 'Vous n\êtes pas connecté !');
        header('Location: /');
    }


    public function signInValid()
    {
        if ($this->userSession === null) {

            $data = $this->userModel->getUserByEmail($this->post->getPost('email'));
            $password = $data->mot_de_passe;

            if ($data->is_actif === "0") {
                $this->alert('danger', "Votre compte à été désactivé par un administrateur.");
                header('Location: /utilisateurs/signin');
            }

            $verif = $this->validation->signInValid($this->post->getPost('email'), $this->allPosts, $this->post->getPost('password'), $password, $data);

            if ($verif !== true) {
                $this->alert('danger', $verif);
                header('Location: /utilisateurs/signin');
            }

            $_SESSION['user'] = [
                'id' => $data->id_utilisateur,
                'email' => $data->email,
                'prenom' => $data->prenom,
                'role' => $data->role
            ];

            if ($data->role === 'ADMIN') {
                $_SESSION['user'] = [
                    'id' => $data->id_utilisateur,
                    'email' => $data->email,
                    'prenom' => $data->prenom,
                    'role' => $data->role,
                    'token' => bin2hex(random_bytes(32))
                ];
            }

            $this->alert('success', 'Bienvenue ' . $data->prenom . ' sur mon blog !');
            header('Location: /');
            return;
        }

        $this->alert('danger', "Vous êtes déjà connecté !");
        header('Location: /');
    }


    public function signin()
    {
        if ($this->userSession === null) {

            // On créer le formulaire
            $this->form->debutForm('post', '/utilisateurs/signinValid')
                ->ajoutLabelFor('email', 'Email :')
                ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true'])
                ->ajoutLabelFor('password', 'Mot de passe :')
                ->ajoutInput('password', 'password', ['class' => 'form-control mb-3', 'id' => 'password', 'required' => 'true'])
                ->ajoutBouton("Me connecter", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            return $this->render('utilisateurs/signin', [
                'form' => $this->form->create()
            ]);
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', "Vous êtes déjà connecté !");
        header('Location: /');
    }


    public function signupValid()
    {
        if ($this->userSession === null) {

            $data = $this->userModel->getUserByEmail($this->post->getPost('email'));

            $verif = $this->validation->signUpValid($this->post->getPost('email'), $this->allPosts, $this->post->getPost('password'), $this->post->getPost('password-again'), $data);

            if ($verif !== true) {
                $this->alert('danger', $verif);
                header('Location: /utilisateurs/signup');
            }

            $email = htmlspecialchars($this->post->getPost('email'));
            $prenom = htmlspecialchars($this->post->getPost('prenom'));
            $pswd = password_hash(htmlspecialchars($this->post->getPost('password')), PASSWORD_ARGON2I);

            $this->userModel->createUser($email, $pswd, $prenom);

            $this->alert('success', 'Votre inscription a bien fonctionné !');
            $this->mailer->sendConfirmationSignUp($email);
            header('Location: /utilisateurs/signin');
            return;
        }
        // if user session exists no access to signup
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    public function signup()
    {
        if ($this->userSession === null) {

            $this->form->debutForm('post', '/utilisateurs/signupValid')
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

            return $this->render('utilisateurs/signup', [
                'form' => $this->form->create()
            ]);
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    public function forgotPassword()
    {
        if ($this->userSession === null) {

            $this->form->debutForm('post', '/utilisateurs/forgotPasswordValidation')
                ->ajoutLabelFor('email', 'Email :')
                ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true'])
                ->ajoutBouton("Soumettre", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            return $this->render('utilisateurs/forgot-password', [
                'form' => $this->form->create()
            ]);
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    public function forgotPasswordValidation()
    {
        if ($this->userSession === null) {

            $data = $this->userModel->getUserByEmail($this->post->getPost('email'));

            $verif = $this->validation->forgotPassValid($this->post->getPost('email'), $this->allPosts, $data);

            if ($verif !== true) {

                $this->alert('danger', $verif);
                header('Location: /utilisateurs/forgotPassword');
            }

            $token = bin2hex(random_bytes(32));
            $email = htmlspecialchars($this->post->getPost('email'));

            $this->userModel->updateToken($token, $email);
            $this->mailer->resetPassword($email, "http://localhost:8000/utilisateurs/newPassword/$token");

            $this->alert('success', 'Un mail vient de vous être envoyé. (Vérifié vos spams)');
            header("Location: /utilisateurs/forgotPassword");
            return;
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    public function newPassword($token)
    {
        if ($this->userSession === null) {

            $data = $this->userModel->getUserByToken($token);

            if ($data === null) {
                $this->alert('danger', 'Vous n\'avez pas accès à cette page.');
                header("Location: /");
            }

            $this->form->debutForm('post', "/utilisateurs/newPasswordValidation/$token")
                ->ajoutLabelFor('password', 'Mot de passe :')
                ->ajoutInput('password', 'password', ['class' => 'form-control mb-3', 'id' => 'password', 'required' => 'true'])
                ->ajoutBouton("Soumettre", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            return $this->render('utilisateurs/new-password', [
                'form' => $this->form->create()
            ]);
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    public function newPasswordValidation($token)
    {
        // si utilisateur est connecté on le redirige
        if ($this->userSession === null) {

            $verif = $this->validation->newPassValid($this->post->getPost('password'), $this->allPosts);

            if ($verif !== true) {

                $this->alert('danger', $verif);
                header('Location: /utilisateurs/forgotPassword');
            }

            $pswd = password_hash(htmlspecialchars($this->post->getPost('password')), PASSWORD_ARGON2I);

            $this->userModel->updateTokenAndPasswordByToken($pswd, 'NULL', $token);

            $this->alert('success', 'Votre mot de passe a été mis à jour.');
            header("Location: /utilisateurs/signin");
            return;
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    public function modifier()
    {
        if ($this->userSession !== null) {

            $data = $this->userModel->getUserById($_SESSION['user']['id']);

            $user = new Utilisateurs;
            $user->setIdUtilisateur($data->id_utilisateur)
                ->setPrenom($data->prenom)
                ->setEmail($data->email)
                ->setMotDePasse($data->mot_de_passe);

            $this->form->debutForm('post', '/utilisateurs/modifierValid')
                ->ajoutLabelFor('prenom', 'Prénom :')
                ->ajoutInput('text', 'prenom', ['class' => 'form-control mb-3', 'id' => 'prenom', 'required' => 'true', "value" => $user->getPrenom()])
                ->ajoutLabelFor('email', 'Email :')
                ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true', "value" => $user->getEmail()])
                ->ajoutLabelFor('password', 'Nouveau mot de passe :')
                ->ajoutInput('password', 'password', ['class' => 'form-control mb-3', 'id' => 'password'])
                ->ajoutLabelFor('password', 'Confirmer mot de passe :')
                ->ajoutInput('password', 'password-again', ['class' => 'form-control mb-3', 'id' => 'password-again'])
                ->ajoutBouton("Soumettre", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            return $this->render('utilisateurs/modifier', [
                'form' => $this->form->create()
            ]);
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté !');
        header('Location: /');
    }


    public function modifierValid()
    {
        if ($this->userSession !== null) {

            $verif = $this->validation->modifierValid($this->post->getPost('email'), [$this->post->getPost('email'), $this->post->getPost('prenom')]);

            if ($verif !== true) {

                $this->alert('danger', $verif);
                header('Location: /utilisateurs/forgotPassword');
            }

            $data = $this->userModel->getUserById($this->userSession['id']);
            $password = password_hash(htmlspecialchars($this->post->getPost('password')), PASSWORD_ARGON2I);

            if (empty($this->post->getPost('password'))) {
                $password = $data->mot_de_passe;
            }

            $this->userModel->updateUserById($this->userSession['id'], htmlspecialchars($this->post->getPost('prenom')), htmlspecialchars($this->post->getPost('email')), $password);

            $this->alert('success', 'Votre compte a été mis à jour.');
            header("Location: /utilisateurs/profil");
            return;
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté !');
        header('Location: /');
    }


    public function logout()
    {
        session_start(); // start the session if it hasn't been started already

        session_unset(); // unset all session variables

        session_destroy(); // destroy the session
        header('Location: /');
        return;
    }
}
