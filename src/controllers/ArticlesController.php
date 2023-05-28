<?php

namespace App\Controllers;

use App\Config\Files;
use App\Config\Post;
use App\Config\Session;
use App\Core\Form;
use App\Model\ArticleModel;
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
    protected Session $session;
    protected null|array $userSession;
    protected Form $form;
    protected ArticleModel $articleModel;
    protected CategorieModel $categorieModel;
    protected CommentaireModel $commentaireModel;
    protected ImageTreatment $imgTreatment;
    protected Validation $validation;


    public function __construct()
    {
        $this->files = new Files;
        $this->post = new Post;
        $this->session = new Session;
        $this->userSession = $this->session->getSession('user');
        $this->form = new Form;
        $this->articleModel = new ArticleModel;
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

            $commentaires = $this->commentaireModel->getCommentairesByArticleId($article->getIdArticle());


            // On créer le formulaire
            $this->form->debutForm('post', "/articles/addCommentaire/{$article->getIdArticle()}")
                ->ajoutLabelFor('commentaire', 'Commentaire :')
                ->ajoutTextarea('commentaire', "", ['class' => 'form-control mb-3', 'id' => 'commentaire', 'rows' => 5, 'required' => 'true'])
                ->ajoutBouton("Ajouter", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            if ($this->userSession === null) {
                $this->render('articles/article-unique', [
                    'article' => $article,
                    'commentaires' => $commentaires
                ]);
                return;
            }

            $this->render('articles/article-unique', [
                'article' => $article,
                'commentaires' => $commentaires,
                'form' => $this->form->create()
            ]);
            return;
        }
        $this->alert('danger', 'L\'article que vous cherchez n\'existe pas.');
        header('Location: /articles/all');
        return;
    }


    /**
     * all function
     *
     * @return void
     */
    public function all(): void
    {
        $articles = $this->articleModel->getAllArticles();

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

                $verif = $this->validation->addArticleValid($this->post->getPost('chapo'), $this->post->getPost('titre'), $this->post->getPost('contenu'));

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
            return;
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
        return;
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
                    $newArray[$a->getIdCategorie()] =  $a->getType();
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
            return;
        }
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
        return;
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

                // var_dump($data);die();
                if ($data === null) {
                    header('Location: /articles/all');
                }

                $array = $this->categorieModel->getAllCategories();

                $newArray = [];
                foreach ($array as $a) {
                    $newArray[$a->getIdCategorie()] =  $a->getType();
                }

                $this->form->debutForm('post', "/articles/updateValid/$id", ["enctype" => "multipart/form-data"])
                    ->ajoutLabelFor('categorie', 'Categorie :')
                    ->ajoutSelect('categorie', $newArray, ['class' => 'form-control mb-3', 'id' => 'categorie', 'required' => 'true'], [$data->getIdCategorie(), $data->getCategorie()])
                    ->ajoutLabelFor('titre', 'Titre :')
                    ->ajoutInput('text', 'titre', ['class' => 'form-control mb-3', 'id' => 'titre', 'required' => 'true', 'value' => $data->getTitre()])
                    ->ajoutLabelFor('chapo', 'Chapô :')
                    ->ajoutTextarea('chapo', $data->getChapo(), ['class' => 'form-control mb-3', 'id' => 'chapo', 'rows' => 3, 'required' => 'true'])
                    ->ajoutLabelFor('contenu', 'Contenu :')
                    ->ajoutTextarea('contenu', $data->getContenu(), ['class' => 'form-control mb-3', 'id' => 'contenu', 'rows' => 10, 'required' => 'true'])
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
            return;
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
        return;
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
                    unlink("uploads/{$data->getImg()}");
                    $imgUrl = $this->imgTreatment->addFile($this->files->getFiles('img'), 'uploads/');
                } else {
                    $imgUrl = $data->getImg();
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
            return;
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
        return;
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
            return;
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
        return;
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
        if ($this->userSession !== null) {

            if ($this->userSession['role'] === "ADMIN") {

                if ($this->userSession['token'] === $this->post->getPost('token')) {

                    $data = $this->articleModel->getArticleById($id);
                    $img = "uploads/{$data->getImg()}";

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
                    return;
                }
                // si utilisateur n'est pas connecté on le redirige
                $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                header('Location: /');
                return;
            }
            // si utilisateur n'est pas admin on le redirige
            $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page.');
            header('Location: /');
            return;
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
        return;
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
                header("Location: /articles/unique/{$article->getSlug()}");
                return;
            }

            if ($article !== null) {
                $slug = $article->getSlug();
            }

            $this->commentaireModel->addCommentaire($this->post->getPost('commentaire'), $this->userSession['id'], $id);

            // si utilisateur n'est pas connecté on le redirige
            $this->alert('success', 'Votre commentaire à été publié, un administrateur le validera dans les 48h.');
            header("Location: /articles/unique/$slug");
            return;
        }
        // si utilisateur n'est pas connecté on le redirige
        $this->alert('danger', 'Vous n\'êtes pas connecté.');
        header('Location: /');
        return;
    }
}
