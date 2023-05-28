<?php

namespace App\Controllers;

use App\Config\Post;
use App\Config\Session;
use App\Core\Form;
use App\Model\UtilisateurModel;
use App\Validation\Validation;
use App\Core\Mailer;

/**
 * Utilisateurs Controller file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class UtilisateursController extends Controller
{

    protected Post $post;
    protected Session $session;
    protected null|array $userSession;
    protected Form $form;
    protected UtilisateurModel $userModel;
    protected Validation $validation;
    protected Mailer $mailer;


    public function __construct()
    {
        $this->post = new Post;
        $this->session = new Session;
        $this->userSession = $this->session->getSession('user');
        $this->form = new Form;
        $this->userModel = new UtilisateurModel;
        $this->validation = new Validation;
        $this->mailer = new Mailer;
    }


    /**
     * profil function
     *
     * @return void
     */
    public function profil(): void
    {
        if ($this->userSession !== null) {

            $user = $this->userModel->getUserById($_SESSION['user']['id']);

            $this->render('utilisateurs/index', [
                'user' => $user
            ]);
            return;
        }

        $this->alert('danger', 'Vous n\êtes pas connecté !');
        header('Location: /');
    }


    /**
     * signInValid function
     *
     * @return void
     */
    public function signInValid(): void
    {
        if ($this->userSession === null) {

            $verif = $this->validation->signInValid($this->post->getPost('email'), $this->post->getPost('password'));

            if ($verif !== true) {
                $this->alert('danger', $verif);
                header('Location: /utilisateurs/signin');
                return;
            }

            $user = $this->userModel->getUserByEmail($this->post->getPost('email'));

            if (is_null($user) || password_verify($this->post->getPost('password'), $user->getMotDePasse()) === false) {
                $this->alert('danger', "L'adresse mail et/ou le mot de passe est incorrect.");
                header('Location: /utilisateurs/signin');
                return;
            }

            if ($user->getIsActif() === "0") {
                $this->alert('danger', "Votre compte à été désactivé par un administrateur.");
                header('Location: /utilisateurs/signin');
                return;
            }

            if ($user->getVerifToken() === null) {
                $this->alert('danger', "Votre compte n'est pas vérifié. Veuillez accéder à votre boite mail et valider votre compte.");
                header('Location: /utilisateurs/signin');
                return;
            }

            $_SESSION['user'] = [
                'id' => $user->getIdUtilisateur(),
                'email' => $user->getEmail(),
                'prenom' => $user->getPrenom(),
                'role' => $user->getRole()
            ];

            if ($user->getRole() === 'ADMIN') {
                $_SESSION['user']['token'] = bin2hex(random_bytes(32));
            }

            $this->alert('success', 'Bienvenue ' . $user->getPrenom() . ' sur mon blog !');
            header('Location: /');
            return;
        }

        $this->alert('danger', "Vous êtes déjà connecté !");
        header('Location: /');
    }


    /**
     * signin function
     *
     * @return void
     */
    public function signin(): void
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

            $this->render('utilisateurs/signin', [
                'form' => $this->form->create()
            ]);
            return;
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', "Vous êtes déjà connecté !");
        header('Location: /');
    }


    /**
     * signupValid function
     *
     * @return void
     */
    public function signupValid(): void
    {
        if ($this->userSession === null) {

            $user = $this->userModel->getUserByEmail($this->post->getPost('email'));

            if (is_null($user) === false) {
                $this->alert('danger', "L'adresse mail existe déjà en base de données.");
                return;
            }

            $verif = $this->validation->signUpValid($this->post->getPost('email'), $this->post->getPost('password'), $this->post->getPost('password-again'), $this->post->getPost('prenom'));

            if ($verif !== true) {
                $this->alert('danger', $verif);
                header('Location: /utilisateurs/signup');
                return;
            }

            $rgpd = $this->post->getPost('rgpd');
            if(isset($rgpd) === false) {
                $this->alert('danger', "Vous devez accepter les RGPD pour vous inscrire.");
                return;
            }

            $email = htmlspecialchars($this->post->getPost('email'));
            $prenom = htmlspecialchars($this->post->getPost('prenom'));
            $pswd = password_hash(htmlspecialchars($this->post->getPost('password')), PASSWORD_ARGON2I);

            $this->userModel->createUser($email, $pswd, $prenom);
            $this->alert('success', 'Votre inscription a bien fonctionné ! Veuillez vérifier vos mails pour valdier votre compte.');

            $user = $this->userModel->getUserByEmail($this->post->getPost('email'));
            $this->mailer->sendConfirmationSignUp($user);
            header('Location: /utilisateurs/signin');
            return;
        }
        // if user session exists no access to signup
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    /**
     * signup function
     *
     * @return void
     */
    public function signup(): void
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

            $this->render('utilisateurs/signup', [
                'form' => $this->form->create()
            ]);
            return;
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    /**
     * forgotPassword function
     *
     * @return void
     */
    public function forgotPassword(): void
    {
        if ($this->userSession === null) {

            $this->form->debutForm('post', '/utilisateurs/forgotPasswordValidation')
                ->ajoutLabelFor('email', 'Email :')
                ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true'])
                ->ajoutBouton("Soumettre", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            $this->render('utilisateurs/forgot-password', [
                'form' => $this->form->create()
            ]);
            return;
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    /**
     * forgotPasswordValidation function
     *
     * @return void
     */
    public function forgotPasswordValidation(): void
    {
        if ($this->userSession === null) {

            $verif = $this->validation->forgotPassValid($this->post->getPost('email'));

            if ($verif !== true) {
                $this->alert('danger', $verif);
                header('Location: /utilisateurs/forgotPassword');
                return;
            }

            $token = bin2hex(random_bytes(32));
            $email = htmlspecialchars($this->post->getPost('email'));
            
            $this->userModel->updateToken($token, $email);
            $user = $this->userModel->getUserByEmail($this->post->getPost('email'));

            $this->mailer->resetPassword($user);

            $this->alert('success', 'Un mail vient de vous être envoyé. (Vérifié vos spams)');
            header("Location: /utilisateurs/forgotPassword");
            return;
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    /**
     * newPassword function
     *
     * @param string $token
     * @return void
     */
    public function newPassword(string $token): void
    {
        if ($this->userSession === null) {

            $user = $this->userModel->getUserByToken($token);

            if ($user === null) {
                $this->alert('danger', 'Vous n\'avez pas accès à cette page.');
                header("Location: /");
                return;
            }

            $this->form->debutForm('post', "/utilisateurs/newPasswordValidation/$token")
                ->ajoutLabelFor('password', 'Mot de passe :')
                ->ajoutInput('password', 'password', ['class' => 'form-control mb-3', 'id' => 'password', 'required' => 'true'])
                ->ajoutBouton("Soumettre", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            $this->render('utilisateurs/new-password', [
                'form' => $this->form->create()
            ]);
            return;
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    /**
     * newPasswordValidation function
     *
     * @param string $token
     * @return void
     */
    public function newPasswordValidation(string $token): void
    {
        // si utilisateur est connecté on le redirige
        if ($this->userSession === null) {

            $verif = $this->validation->newPassValid($this->post->getPost('password'));

            if ($verif !== true) {
                $this->alert('danger', $verif);
                header('Location: /utilisateurs/forgotPassword');
                return;
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


    /**
     * modifier function
     *
     * @return void
     */
    public function modifier(): void
    {
        if ($this->userSession !== null) {

            $user = $this->userModel->getUserById($this->userSession['id']);

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

            $this->render('utilisateurs/modifier', [
                'form' => $this->form->create()
            ]);
            return;
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté !');
        header('Location: /');
    }


    /**
     * modifierValid function
     *
     * @return void
     */
    public function modifierValid(): void
    {
        if ($this->userSession !== null) {

            $verif = $this->validation->modifierValid($this->post->getPost('email'), $this->post->getPost('prenom'));

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


    /**
     * verify function
     *
     * @param string $token
     * @return void
     */
    public function verify(string $token): void
    {
        if ($this->userSession === null) {

            $user = $this->userModel->getUserByVerifToken($token);

            if ($user === null) {
                $this->alert('danger', 'Vous n\'avez pas accès à cette page.');
                header("Location: /");
                return;
            }

            $this->form->debutForm('post', "/utilisateurs/verifyValidation/{$user->getidUtilisateur()}")
                ->ajoutBouton("Soumettre", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            $this->render('utilisateurs/verify-account', [
                'form' => $this->form->create()
            ]);
            return;
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    /**
     * verifyValidation function
     *
     * @param string $id
     * @return void
     */
    public function verifyValidation(string $id): void
    {
        // si utilisateur est connecté on le redirige
        if ($this->userSession === null) {

            $this->userModel->updateVerifToken($id);

            $this->alert('success', 'Votre compte à été vérifié.');
            header("Location: /utilisateurs/signin");
            return;
        }
        // si utilisateur est connecté on le redirige
        $this->alert('danger', 'Vous êtes déjà connecté !');
        header('Location: /');
    }


    /**
     * logout function
     *
     * @return void
     */
    public function logout(): void
    {
        session_unset(); // unset all session variables

        session_destroy(); // destroy the session
        header('Location: /');
        return;
    }
}
