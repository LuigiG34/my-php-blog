<?php

namespace App\Controllers;

use App\Config\Files;
use App\Config\Post;
use App\Config\Session;
use App\Core\Form;
use App\Entity\Articles;
use App\Entity\Commentaires;
use App\Model\ArticlesModel;
use App\Model\CategorieModel;
use App\Model\CommentaireModel;
use App\Validation\ImageTreatment;
use App\Validation\Validation;


class ArticlesController extends Controller
{

    protected $files;
    protected $post;
    protected $allPosts;
    protected $session;
    protected $userSession;
    protected $form;
    protected $articleModel;
    protected $categorieModel;
    protected $commentaireModel;
    protected $imgTreatment;
    protected $validation;


    public function __construct()
    {
        $this->files = new Files;
        $this->post = new Post;
        $this->allPosts = $this->post->getAllPost();
        $this->session = new Session;
        $this->userSession = $this->session->getSession('user');
        $this->form = new Form;
        $this->articleModel = new ArticlesModel;
        $this->categorieModel = new CategorieModel;
        $this->commentaireModel = new CommentaireModel;
        $this->imgTreatment = new ImageTreatment;
        $this->validation = new Validation;
    }

    public function unique($slug)
    {
        $article = $this->articleModel->getArticleBySlug($slug);

        if ($article !== null) {

            $entity = new Articles;
            $entity->setIdArticle($article->id_article)
                ->setTitre($article->titre)
                ->setChapo($article->chapo)
                ->setContenu($article->contenu)
                ->setCreatedAt($article->created_at)
                ->setImg($article->img)
                ->setCategorie($article->type)
                ->setAuteur($article->prenom);

            $commentaires = $this->commentaireModel->getCommentairesByArticleId($article->id_article);

            $array = [];

            if ($commentaires !== null) {
                foreach ($commentaires as $c) {
                    $ent = new Commentaires;
                    $ent->setCreatedAt($c->created_at)
                        ->setContenu($c->contenu)
                        ->setAuteur($c->prenom)
                        ->setStatut($c->type);

                    $array[] = $ent;
                }
            }

            // On créer le formulaire
            $this->form->debutForm('post', "/articles/addCommentaire/$article->id_article")
                ->ajoutLabelFor('commentaire', 'Commentaire :')
                ->ajoutTextarea('commentaire', "", ['class' => 'form-control mb-3', 'id' => 'commentaire', 'rows' => 5, 'required' => 'true'])
                ->ajoutBouton("Ajouter", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            if ($this->userSession === null) {
                return $this->render('articles/article-unique', [
                    'article' => $entity,
                    'commentaires' => $array
                ]);
            }

            return $this->render('articles/article-unique', [
                'article' => $entity,
                'commentaires' => $array,
                'form' => $this->form->create()
            ]);
        }
        $this->alert('danger', 'L\'article que vous cherchez n\'existe pas.');
        header('Location: /articles/all');
    }


    public function all()
    {
        $array = $this->articleModel->getAllArticles();
        $articles = [];

        foreach ($array as $article) {
            $entity = new Articles;
            $entity->setIdArticle($article->id_article)
                ->setTitre($article->titre)
                ->setChapo($article->chapo)
                ->setContenu($article->contenu)
                ->setCreatedAt($article->created_at)
                ->setImg($article->img)
                ->setSlug($article->slug)
                ->setCategorie($article->type)
                ->setAuteur($article->prenom);

            $articles[] = $entity;
        }

        return $this->render('articles/articles-archive', [
            'articles' => $articles
        ]);
    }


    public function addValid()
    {
        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {

                $verif = $this->validation->addArticleValid($this->allPosts);

                if ($verif !== true) {
                    $this->alert('danger', $verif);
                    header('Location: /articles/add');
                }

                $imgUrl = $this->imgTreatment->addFile($this->files->getFiles('img'), 'uploads/');
                $slug = $this->generateSlug(htmlspecialchars($this->post->getPost('titre')));

                $this->articleModel->addArticle(htmlspecialchars($this->post->getPost('titre')), htmlspecialchars($this->post->getPost('chapo')), htmlspecialchars($this->post->getPost('contenu')), $imgUrl, $slug, htmlspecialchars($this->post->getPost('categorie')), $this->userSession['id']);

                $this->alert('success', 'L\'article a bien été ajouté');
                header('Location: /');
                return;
            }
            // si utilisateur n'est pas admin on le redirige
            $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
            header('Location: /');
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
    }


    public function add()
    {
        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {

                $array = $this->categorieModel->getAllCategories();

                $newArray = [];
                foreach ($array as $a) {
                    $newArray[$a->id_categorie] =  $a->type;
                }

                $this->form->debutForm('post', '/articles/addValid', ["enctype" => "multipart/form-data"])
                    ->ajoutLabelFor('categorie', 'Categorie :')
                    ->ajoutSelect('categorie', $newArray, ['class' => 'form-control mb-3', 'id' => 'categorie', 'required' => 'true'])
                    ->ajoutLabelFor('titre', 'Titre :')
                    ->ajoutInput('text', 'titre', ['class' => 'form-control mb-3', 'id' => 'titre', 'required' => 'true'])
                    ->ajoutLabelFor('chapo', 'Chapô :')
                    ->ajoutTextarea('chapo', '', ['class' => 'form-control mb-3', 'id' => 'chapo', 'rows' => 3, 'required' => 'true'])
                    ->ajoutLabelFor('contenu', 'Contenu :')
                    ->ajoutTextarea('contenu', '', ['class' => 'form-control mb-3', 'id' => 'contenu', 'rows' => 10, 'required' => 'true'])
                    ->ajoutLabelFor('img', 'Image :')
                    ->ajoutInput('file', 'img', ['class' => 'form-control mb-3', 'id' => 'img', 'required' => 'true'])
                    ->ajoutBouton("Ajouter", ['class' => 'btn btn-primary w-100 mt-3'])
                    ->finForm();

                return $this->render('articles/add', [
                    'form' => $this->form->create()
                ]);
            }
            // si utilisateur n'est pas admin on le redirige
            $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page.');
            header('Location: /');
        }
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
    }


    public function update($id)
    {
        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {

                $data = $this->articleModel->getArticleById($id);

                if ($data === null) {
                    header('Location: /articles/all');
                }

                $array = $this->categorieModel->getAllCategories();

                $newArray = [];
                foreach ($array as $a) {
                    $newArray[$a->id_categorie] =  $a->type;
                }

                $this->form->debutForm('post', "/articles/updateValid/$id", ["enctype" => "multipart/form-data"])
                    ->ajoutLabelFor('categorie', 'Categorie :')
                    ->ajoutSelect('categorie', $newArray, ['class' => 'form-control mb-3', 'id' => 'categorie', 'required' => 'true'], [$data->id_categorie, $data->type])
                    ->ajoutLabelFor('titre', 'Titre :')
                    ->ajoutInput('text', 'titre', ['class' => 'form-control mb-3', 'id' => 'titre', 'required' => 'true', 'value' => $data->titre])
                    ->ajoutLabelFor('chapo', 'Chapô :')
                    ->ajoutTextarea('chapo', $data->chapo, ['class' => 'form-control mb-3', 'id' => 'chapo', 'rows' => 3, 'required' => 'true'])
                    ->ajoutLabelFor('contenu', 'Contenu :')
                    ->ajoutTextarea('contenu', $data->contenu, ['class' => 'form-control mb-3', 'id' => 'contenu', 'rows' => 10, 'required' => 'true'])
                    ->ajoutLabelFor('img', 'Image :')
                    ->ajoutInput('file', 'img', ['class' => 'form-control mb-3', 'id' => 'img'])
                    ->ajoutBouton("Ajouter", ['class' => 'btn btn-primary w-100 mt-3'])
                    ->finForm();

                return $this->render('articles/update', [
                    'form' => $this->form->create()
                ]);
            }
            // si utilisateur n'est pas admin on le redirige
            $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page.');
            header('Location: /');
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
    }


    public function updateValid($id)
    {

        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {

                $data = $this->articleModel->getArticleById($id);

                if ($data === null) {
                    $this->alert('danger', 'L\'article que vous cherchez n\'existe pas.');
                    header('Location: /articles/all');
                }

                if ($this->files->getFiles('img')['size'] > 0) {
                    unlink("uploads/$data->img");
                    $imgUrl = $this->imgTreatment->addFile($this->files->getFiles('img'), 'uploads/');
                } else {
                    $imgUrl = $data->img;
                }

                $slug = $this->generateSlug(htmlspecialchars($this->post->getPost('titre')));

                $this->articleModel->updateArticle($id, htmlspecialchars($this->post->getPost('titre')), htmlspecialchars($this->post->getPost('chapo')), htmlspecialchars($this->post->getPost('contenu')), $imgUrl, $slug, htmlspecialchars($this->post->getPost('categorie')));

                $this->alert('success', 'L\'article a bien été modifié !');
                header("Location: /articles/unique/$slug");
                return;
            }
            // si utilisateur n'est pas admin on le redirige
            $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page.');
            header('Location: /');
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
    }


    public function delete($id)
    {
        // si utilisateur n'est pas connecté on le redirige
        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {
                // On créer le formulaire
                $this->form->debutForm('post', "/articles/deleteValid/$id", ["enctype" => "multipart/form-data"])
                    ->ajoutInput('hidden', 'token', ["value" => $this->userSession['token']])
                    ->ajoutBouton("Supprimer", ['class' => 'btn btn-primary w-100 mt-3'])
                    ->finForm();

                return $this->render('articles/delete', [
                    'form' => $this->form->create()
                ]);
            }
            // si utilisateur n'est pas admin on le redirige
            $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page.');
            header('Location: /');
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
    }


    public function deleteValid($id)
    {
        if ($this->userSession === null) {

            if ($this->userSession['role'] === "ADMIN") {

                if ($this->userSession['token'] === $this->post->getPost('token')) {

                    $data = $this->articleModel->getArticleById($id);
                    $img = "uploads/$data->img";

                    if (file_exists($img)) {

                        unlink($img);
                        $this->articleModel->deleteArticle($id);
                        $this->alert('success', 'L\'article a été supprimé !');
                        header('Location: /articles/all');
                        return;
                    }
                    // si utilisateur n'est pas connecté on le redirige
                    $this->alert('danger', 'L\'image n\'existe pas');
                    header('Location: /');
                }
                // si utilisateur n'est pas connecté on le redirige
                $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                header('Location: /');
            }
            // si utilisateur n'est pas admin on le redirige
            $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page.');
            header('Location: /');
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
    }


    public function addCommentaire($id)
    {
        if ($this->userSession === null) {
            $article = $this->articleModel->getArticleById($id);

            if ($article !== null) {
                $slug = $article->slug;
            }

            $this->commentaireModel->addCommentaire($this->post->getPost('commentaire'), $this->userSession['id'], $id);

            // si utilisateur n'est pas connecté on le redirige
            $this->alert('success', 'Votre commentaire à été publié, un administrateur le validera dans les 48h.');
            header("Location: /articles/unique/$slug");
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
    }
}
