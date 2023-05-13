<?php

namespace App\Controllers;

use App\Config\Session;
use App\Entity\Articles;
use App\Entity\Commentaires;
use App\Entity\Utilisateurs;
use App\Model\ArticlesModel;
use App\Model\CommentaireModel;
use App\Model\UtilisateursModel;

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
    protected UtilisateursModel $userModel;
    protected ArticlesModel $articleModel;
    protected CommentaireModel $commentaireModel;


    public function __construct()
    {
        $this->session = new Session;
        $this->userSession = $this->session->getSession('user');
        $this->userModel = new UtilisateursModel;
        $this->articleModel = new ArticlesModel;
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
                $array = [];

                if ($users !== null) {

                    foreach ($users as $u) {

                        if ($u->role === "USER") {

                            $entity = new Utilisateurs;

                            $entity->setIdUtilisateur($u->id_utilisateur)
                                ->setPrenom($u->prenom)
                                ->setEmail($u->email)
                                ->setCreatedAt($u->created_at)
                                ->setRole($u->role)
                                ->setIsActif($u->is_actif);

                            $array[] = $entity;
                        }
                    }
                }

                $this->render('admin/users', [
                    'users' => $array
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

                $array = $this->articleModel->getAllArticles();
                $articles = [];

                if ($array !== null) {

                    foreach ($array as $article) {

                        $entity = new Articles;
                        $entity->setIdArticle($article->id_article)
                            ->setTitre($article->titre)
                            ->setChapo($article->chapo)
                            ->setCreatedAt($article->created_at)
                            ->setImg($article->img)
                            ->setCategorie($article->type)
                            ->setAuteur($article->prenom);

                        $articles[] = $entity;
                    }
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

                $data = $this->commentaireModel->getAllCommentaires();
                $array = [];

                if ($data !== null) {

                    foreach ($data as $d) {

                        $entity = new Commentaires;
                        $entity->setArticle($d->titre)
                            ->setContenu($d->contenu)
                            ->setStatut($d->type)
                            ->setAuteur($d->email)
                            ->setIdStatutCommentaire($d->id_statut_commentaire)
                            ->setIdCommentaire($d->id_commentaire);

                        $array[] = $entity;
                    }
                }

                $this->render('admin/comments', [
                    'comments' => $array
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

                    if ($data->id_statut_commentaire === "1") {
                        return $this->commentaireModel->updateStatus($id, 2);
                    }

                    if ($data->id_statut_commentaire === "2") {
                        return $this->commentaireModel->updateStatus($id, 1);
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

                    if ($data->is_actif === "1") {
                        return $this->userModel->updateActif($id, 0);
                    }

                    if ($data->is_actif === "0") {
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
