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
 * ArticlesController
 */
class ArticlesController extends Controller
{

    public function unique($slug)
    {
        $articleModel = new ArticlesModel;
        $session = new Session;

        $article = $articleModel->getArticleBySlug($slug);

        if ($article !== null) {

            $entity = new Articles;
            $entity->setId_article($article->id_article)
                ->setTitre($article->titre)
                ->setChapo($article->chapo)
                ->setContenu($article->contenu)
                ->setCreated_at($article->created_at)
                ->setImg($article->img)
                ->setCategorie($article->type)
                ->setAuteur($article->prenom);

            $user = $session->getSession('user');
            // si utilisateur n'est pas connecté on le redirige

            $commentaireModel = new CommentaireModel;

            $commentaires = $commentaireModel->getCommentairesByArticleId($article->id_article);

            $array = [];

            if($commentaires !== null){
                foreach ($commentaires as $c) {
                    $ent = new Commentaires;
                    $ent->setCreated_at($c->created_at)
                        ->setContenu($c->contenu)
                        ->setAuteur($c->prenom)
                        ->setStatut($c->type);
    
                    $array[] = $ent;
                }
            }
            

            // On créer le formulaire
            $form = new Form;

            $form->debutForm('post', "/articles/addCommentaire/$article->id_article")

                ->ajoutLabelFor('commentaire', 'Commentaire :')
                ->ajoutTextarea('commentaire', "", ['class' => 'form-control mb-3', 'id' => 'commentaire', 'rows' => 5, 'required' => 'true'])

                ->ajoutBouton("Ajouter", ['class' => 'btn btn-primary w-100 mt-3'])
                ->finForm();

            if ($user === null) {
                $this->render('articles/article-unique', [
                    'article' => $entity,
                    'commentaires' => $array
                ]);
            } else {
                $this->render('articles/article-unique', [
                    'article' => $entity,
                    'commentaires' => $array,
                    'form' => $form->create()
                ]);
            }
        } else {
            header('Location: /articles/all');
        }
    }

    public function all()
    {
        $articleModel = new ArticlesModel;
        $articles = [];

        $array = $articleModel->getAllArticles();

        foreach ($array as $article) {
            $entity = new Articles;
            $entity->setId_article($article->id_article)
                ->setTitre($article->titre)
                ->setChapo($article->chapo)
                ->setContenu($article->contenu)
                ->setCreated_at($article->created_at)
                ->setImg($article->img)
                ->setSlug($article->slug)
                ->setCategorie($article->type)
                ->setAuteur($article->prenom);

            $articles[] = $entity;
        }

        $this->render('articles/articles-archive', [
            'articles' => $articles
        ]);
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

    public function update($id)
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
                $data = $articleModel->getArticleById($id);

                if ($data === null) {
                    header('Location: /articles/all');
                }

                $categories = new CategorieModel;
                $array = $categories->getAllCategories();

                $newArray = [];
                foreach ($array as $a) {
                    $newArray[$a->id_categorie] =  $a->type;
                }



                // On créer le formulaire
                $form = new Form;

                $form->debutForm('post', "/articles/updateValid/$id", ["enctype" => "multipart/form-data"])
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
                    'form' => $form->create()
                ]);
            } else {
                // si utilisateur n'est pas connecté on le redirige
                $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                header('Location: /');
            }
        }
    }

    public function updateValid($id)
    {
        $session = new Session;
        $post = new Post;
        $file = new Files;
        $img = new ImageTreatment;
        $articleModel = new ArticlesModel;

        $user = $session->getSession('user');

        // si utilisateur n'est pas connecté on le redirige
        if ($user === null) {
            // si utilisateur n'est pas connecté on le redirige
            header('Location: /');
        } else {

            if ($user['role'] === "ADMIN") {

                $data = $articleModel->getArticleById($id);

                if ($data === null) {
                    header('Location: /articles/all');
                }

                if ($file->getFiles('img')['size'] > 0) {
                    unlink("uploads/$data->img");
                    $imgUrl = $img->addFile($file->getFiles('img'), 'uploads/');
                } else {
                    $imgUrl = $data->img;
                }

                $slug = $this->generateSlug(strip_tags($post->getPost('titre')));

                $articleModel->updateArticle($id, strip_tags($post->getPost('titre')), strip_tags($post->getPost('chapo')), strip_tags($post->getPost('contenu')), $imgUrl, $slug, strip_tags($post->getPost('categorie')));

                $this->alert('success', 'L\'article a bien été modifié !');
                header("Location: /articles/unique/$slug");
            } else {
                // si utilisateur n'est pas connecté on le redirige
                $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                header('Location: /');
            }
        }
    }

    public function delete($id)
    {
        $session = new Session;
        $user = $session->getSession('user');

        // si utilisateur n'est pas connecté on le redirige
        if ($user === null) {

            // si utilisateur n'est pas connecté on le redirige
            header('Location: /');
        } else {

            if ($user['role'] === "ADMIN") {
                // On créer le formulaire
                $form = new Form;

                $form->debutForm('post', "/articles/deleteValid/$id", ["enctype" => "multipart/form-data"])
                    ->ajoutInput('hidden', 'token', ["value" => $user['token']])
                    ->ajoutBouton("Supprimer", ['class' => 'btn btn-primary w-100 mt-3'])
                    ->finForm();

                $this->render('articles/delete', [
                    'form' => $form->create()
                ]);
            } else {
                // si utilisateur n'est pas connecté on le redirige
                $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                header('Location: /');
            }
        }
    }

    public function deleteValid($id)
    {
        $session = new Session;
        $user = $session->getSession('user');
        $post = new Post;

        // si utilisateur n'est pas connecté on le redirige
        if ($user === null) {

            // si utilisateur n'est pas connecté on le redirige
            header('Location: /');
        } else {

            if ($user['role'] === "ADMIN") {

                if ($user['token'] === $post->getPost('token')) {
                    $articleModel = new ArticlesModel;
                    $data = $articleModel->getArticleById($id);
                    $img = "uploads/$data->img";

                    if (file_exists($img)) {

                        unlink($img);
                        $articleModel->deleteArticle($id);
                        $this->alert('success', 'L\'article a été supprimé !');
                        header('Location: /articles/all');
                    } else {
                        // si utilisateur n'est pas connecté on le redirige
                        $this->alert('danger', 'L\'image n\'existe pas');
                        header('Location: /');
                    }
                } else {
                    // si utilisateur n'est pas connecté on le redirige
                    $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                    header('Location: /');
                }
            } else {
                // si utilisateur n'est pas connecté on le redirige
                $this->alert('danger', 'Vous n\'avez pas le droit d\'accéder à cette page');
                header('Location: /');
            }
        }
    }


    public function addCommentaire($id)
    {
        $session = new Session;
        $user = $session->getSession('user');

        $commentaireModel = new CommentaireModel;

        $commentaireModel->addCommentaire($_POST['commentaire'], $user['id'], $id);

        // si utilisateur n'est pas connecté on le redirige
        $this->alert('success', 'Votre commentaire à été publié, un administrateur le validera dans les 48h.');
        header('Location: /articles/all');
    }
}
