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

/**
 * Articles Controller file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class ArticlesController extends Controller
{

    protected Files $files;
    protected Post $post;
    protected array $allPosts;
    protected Session $session;
    protected null|array $userSession;
    protected Form $form;
    protected ArticlesModel $articleModel;
    protected CategorieModel $categorieModel;
    protected CommentaireModel $commentaireModel;
    protected ImageTreatment $imgTreatment;
    protected Validation $validation;


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


    /**
     * unique function
     *
     * @param string $slug
     * 
     * @return void
     */
    public function unique(string $slug): void
    {
        $article = $this->articleModel->getArticleBySlug($slug);

        if ($article !== null) {

            $entity = new Articles;
            $entity->hydrate($article);

            $commentaires = $this->commentaireModel->getCommentairesByArticleId($article->id_article);

            $array = [];

            if ($commentaires !== null) {
                foreach ($commentaires as $c) {
                    $ent = new Commentaires;
                    $ent->hydrate($c);

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
                $this->render('articles/article-unique', [
                    'article' => $entity,
                    'commentaires' => $array
                ]);

                return;
            }

            $this->render('articles/article-unique', [
                'article' => $entity,
                'commentaires' => $array,
                'form' => $this->form->create()
            ]);
            return;
        }
        $this->alert('danger', 'L\'article que vous cherchez n\'existe pas.');
        header('Location: /articles/all');
    }


    /**
     * all function
     *
     * @return void
     */
    public function all(): void
    {
        $array = $this->articleModel->getAllArticles();
        $articles = [];

        foreach ($array as $article) {
            $entity = new Articles;
            $entity->hydrate($article);

            $articles[] = $entity;
        }

        $this->render('articles/articles-archive', [
            'articles' => $articles
        ]);
        return;
    }


    /**
     * addValid function
     *
     * @return void
     */
    public function addValid(): void
    {
        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {

                $verif = $this->validation->addArticleValid($this->allPosts, $this->post->getPost('chapo'), $this->post->getPost('titre'), $this->post->getPost('contenu'));

                if ($verif !== true) {
                    $this->alert('danger', $verif);
                    header('Location: /articles/add');
                    return;
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


    /**
     * add function
     *
     * @return void
     */
    public function add(): void
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

                $this->render('articles/add', [
                    'form' => $this->form->create()
                ]);
                return;
            }
            // si utilisateur n'est pas admin on le redirige
            $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page.');
            header('Location: /');
        }
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
    }


    /**
     * update function
     *
     * @param string $id
     * 
     * @return void
     */
    public function update(string $id): void
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

                $this->render('articles/update', [
                    'form' => $this->form->create()
                ]);
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


    /**
     * updateValid function
     *
     * @param string $id
     * 
     * @return void
     */
    public function updateValid(string $id): void
    {

        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {

                $data = $this->articleModel->getArticleById($id);

                if ($data === null) {
                    $this->alert('danger', 'L\'article que vous cherchez n\'existe pas.');
                    header('Location: /articles/all');
                    return;
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


    /**
     * delete function
     *
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        // si utilisateur n'est pas connecté on le redirige
        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {
                // On créer le formulaire
                $this->form->debutForm('post', "/articles/deleteValid/$id", ["enctype" => "multipart/form-data"])
                    ->ajoutInput('hidden', 'token', ["value" => $this->userSession['token']])
                    ->ajoutBouton("Supprimer", ['class' => 'btn btn-primary w-100 mt-3'])
                    ->finForm();

                $this->render('articles/delete', [
                    'form' => $this->form->create()
                ]);
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


    /**
     * deleteValid function
     *
     * @param string $id
     * 
     * @return void
     */
    public function deleteValid(string $id): void
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


    /**
     * addCommentaire function
     *
     * @param string $id
     * 
     * @return void
     */
    public function addCommentaire(string $id): void
    {
        if ($this->userSession !== null) {

            $article = $this->articleModel->getArticleById($id);

            $verif = $this->validation->addCommentValid($this->post->getPost('commentaire'));

            if($verif !== true) {
                $this->alert('danger', $verif);
                header("Location: /articles/unique/$article->slug");
                return;
            }

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
