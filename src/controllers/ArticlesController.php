<?php

namespace App\Controllers;

use App\Config\Files;
use App\Config\Post;
use App\Config\Session;
use App\Core\Form;
use App\Model\ArticlesModel;
use App\Model\CategorieModel;
use App\Validation\ImageTreatment;
use App\Validation\Validation;

/**
 * ArticlesController
 */
class ArticlesController extends Controller
{
    /**
     * Appelle archive d'articles
     */
    public function index()
    {
        $this->render('articles/articles-archive');
    }


    public function addValid()
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
                $validation = new Validation;
                $post = new Post;
                $file = new Files;

                $allPosts = $post->getAllPost();

                $verif = $validation->addArticleValid($allPosts);

                if ($verif !== true) {

                    $this->alert('danger', $verif);
                    header('Location: /articles/add');

                } else {

                    $img = new ImageTreatment;
                    $articleModel = new ArticlesModel;

                    $imgUrl = $img->addFile($file->getFiles('img'), 'uploads/');
                    $slug = $this->generateSlug(strip_tags($post->getPost('titre')));

                    $articleModel->addArticle(strip_tags($post->getPost('titre')), strip_tags($post->getPost('chapo')), strip_tags($post->getPost('contenu')), $imgUrl, $slug, strip_tags($post->getPost('categorie')), $user['id']);

                    $this->alert('success', 'L\'article a bien été ajouté');
                    header('Location: /');
                }
            } else {
                // si utilisateur n'est pas connecté on le redirige
                $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                header('Location: /');
            }
        }
    }

    public function add()
    {
        $session = new Session;
        $user = $session->getSession('user');

        // si utilisateur n'est pas connecté on le redirige
        if ($user === null) {

            // si utilisateur n'est pas connecté on le redirige
            header('Location: /');
        } else {

            if ($user['role'] === "ADMIN") {
                $categories = new CategorieModel;
                $array = $categories->getAllCategories();

                $newArray = [];
                foreach ($array as $a) {
                    $newArray[$a->id_categorie] =  $a->type;
                }

                // On créer le formulaire
                $form = new Form;

                $form->debutForm('post', '/articles/addValid', ["enctype" => "multipart/form-data"])
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
                    'form' => $form->create()
                ]);
            } else {
                // si utilisateur n'est pas connecté on le redirige
                $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                header('Location: /');
            }
        }
    }
}
