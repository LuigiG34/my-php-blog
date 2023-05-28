<?php

namespace App\Controllers;

use App\Config\Session;
use App\Model\ArticleModel;
use App\Model\CommentaireModel;
use App\Model\UtilisateurModel;

/**
 * Admin Controller file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class AdminController extends Controller
{
    protected Session $session;
    protected null|array $userSession;
    protected UtilisateurModel $userModel;
    protected ArticleModel $articleModel;
    protected CommentaireModel $commentaireModel;


    public function __construct()
    {
        $this->session = new Session;
        $this->userSession = $this->session->getSession('user');
        $this->userModel = new UtilisateurModel;
        $this->articleModel = new ArticleModel;
        $this->commentaireModel = new CommentaireModel;
    }


    /**
     * index function
     *
     * @return void
     */
    public function index(): void
    {
        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {
                
                $this->render('admin/index');
                return;
            }
        }

        $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
        header('Location: /');
    }


    /**
     * users function
     *
     * @return void
     */
    public function users(): void
    {

        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {

                $users = $this->userModel->getAllUsers();

                if ($users === null) {
                    $this->alert('danger', 'Aucun utilisateurs trouvé.');
                }

                $this->render('admin/users', [
                    'users' => $users
                ]);
                return;
            }
        }

        $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
        header('Location: /');
    }


    /**
     * articles function
     *
     * @return void
     */
    public function articles(): void
    {
        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {

                $articles = $this->articleModel->getAllArticles();

                if ($articles === null) {
                    $this->alert('danger', 'Aucun articles trouvé.');
                }

                $this->render('admin/articles', [
                    'articles' => $articles
                ]);
                return;
            }
        }

        $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
        header('Location: /');
    }


    /**
     * comments function
     *
     * @return void
     */
    public function comments(): void
    {
        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {

                $commentaires = $this->commentaireModel->getAllCommentaires();

                if ($commentaires === null) {
                    $this->alert('danger', 'Aucun comentaires trouvé.');
                }

                $this->render('admin/comments', [
                    'comments' => $commentaires
                ]);
                return;
            }
        }

        $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
        header('Location: /');
    }


    /**
     * activeCommentaire function
     *
     * @param string $id
     * @return mixed
     */
    public function activeCommentaire(string $id): mixed
    {                 
        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {

                $data = $this->commentaireModel->getCommentaireById($id);

                if ($data !== null) {                    

                    if ($data->getIdStatutCommentaire() === "1") {
                        return $this->commentaireModel->updateStatus($id, 2, $this->userSession['id']);
                    }

                    if ($data->getIdStatutCommentaire() === "2") {
                        return $this->commentaireModel->updateStatus($id, 1, $this->userSession['id']);
                    }
                }
            }
        }

        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
        header('Location: /');
    }


    /**
     * activeUtilisateur function
     *
     * @param string $id
     * @return mixed
     */
    public function activeUtilisateur(string $id): mixed
    {
        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {

                $data = $this->userModel->getUserById($id);

                if ($data !== null) {

                    if ($data->getIsActif() === "1") {
                        return $this->userModel->updateActif($id, 0);
                    }

                    if ($data->getIsActif() === "0") {
                        return $this->userModel->updateActif($id, 1);
                    }
                }
            }
        }

        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
        header('Location: /');
    }
    
}
