<?php

namespace App\Controllers;

use App\Config\Session;
use App\Entity\Articles;
use App\Entity\Commentaires;
use App\Entity\Utilisateurs;
use App\Model\ArticlesModel;
use App\Model\CommentaireModel;
use App\Model\UtilisateursModel;

class AdminController extends Controller
{
    /**
     * Appelle contact
     */
    public function index()
    {
        $this->render('admin/index');
    }

    public function users()
    {
        $session = new Session;
        $user = $session->getSession('user');

        // si utilisateur n'est pas connecté on le redirige
        if ($user === null) {

            // si utilisateur n'est pas connecté on le redirige
            header('Location: /');
        } else {

            if ($user['role'] === "ADMIN") {

                $userModel = new UtilisateursModel;

                $users = $userModel->getAllUsers();

                $array = [];

                if ($users !== null) {
                    foreach ($users as $u) {
                        if ($u->role === "USER") {
                            $entity = new Utilisateurs;
                            $entity->setId_utilisateur($u->id_utilisateur)
                                ->setPrenom($u->prenom)
                                ->setEmail($u->email)
                                ->setCreated_at($u->created_at)
                                ->setRole($u->role);

                            $array[] = $entity;
                        }
                    }
                }

                $this->render('admin/users', [
                    'users' => $array
                ]);
            } else {
                // si utilisateur n'est pas connecté on le redirige
                $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                header('Location: /');
            }
        }
    }

    public function articles()
    {
        $session = new Session;
        $user = $session->getSession('user');

        // si utilisateur n'est pas connecté on le redirige
        if ($user === null) {

            // si utilisateur n'est pas connecté on le redirige
            header('Location: /');
        } else {

            if ($user['role'] === "ADMIN") {

                $articleModel = new ArticlesModel;
                $articles = [];

                $array = $articleModel->getAllArticles();

                if ($array !== null) {
                    foreach ($array as $article) {
                        $entity = new Articles;
                        $entity->setId_article($article->id_article)
                            ->setTitre($article->titre)
                            ->setChapo($article->chapo)
                            ->setCreated_at($article->created_at)
                            ->setImg($article->img)
                            ->setCategorie($article->type)
                            ->setAuteur($article->prenom);

                        $articles[] = $entity;
                    }
                }

                $this->render('admin/articles', [
                    'articles' => $articles
                ]);
            } else {
                // si utilisateur n'est pas connecté on le redirige
                $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                header('Location: /');
            }
        }
    }

    public function comments()
    {
        $session = new Session;
        $user = $session->getSession('user');

        // si utilisateur n'est pas connecté on le redirige
        if ($user === null) {

            // si utilisateur n'est pas connecté on le redirige
            header('Location: /');
        } else {

            if ($user['role'] === "ADMIN") {

                $commentairesModel = new CommentaireModel;

                $data = $commentairesModel->gettAllCommentaires();
                $array = [];

                if($data !== null)
                {
                    foreach($data as $d){
                        $entity = new Commentaires;
                        $entity->setArticle($d->titre)
                        ->setContenu($d->contenu)
                        ->setStatut($d->type)
                        ->setAuteur($d->email)
                        ->setId_statut_commentaire($d->id_statut_commentaire)
                        ->setId_commentaire($d->id_commentaire);

                        $array[] = $entity;
                    }
                }

                $this->render('admin/comments', [
                    'comments' => $array
                ]);
            } else {
                // si utilisateur n'est pas connecté on le redirige
                $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                header('Location: /');
            }
        }
    }

    public function activeCommentaire($id)
    {
        $session = new Session;
        $user = $session->getSession('user');

        // si utilisateur n'est pas connecté on le redirige
        if ($user === null) {

            // si utilisateur n'est pas connecté on le redirige
            header('Location: /');
        } else {

            if ($user['role'] === "ADMIN") {

                $commentairesModel = new CommentaireModel;

                $data = $commentairesModel->getCommentaireById($id);


                if($data !== null)
                {
                    if($data->id_statut_commentaire === "1"){
                        $commentairesModel->updateStatus($id, 2);
                    }
                    if($data->id_statut_commentaire === "2"){
                        $commentairesModel->updateStatus($id, 1);
                    }
                }

            } else {
                // si utilisateur n'est pas connecté on le redirige
                $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                header('Location: /');
            }
        }
    }
}
