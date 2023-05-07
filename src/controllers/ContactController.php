<?php

namespace App\Controllers;

use App\Config\Post;
use App\Core\Form;
use App\Core\Mailer;
use App\Validation\Validation;

/**
 * ContactController
 */
class ContactController extends Controller
{
    /**
     * Appelle contact
     */
    public function index()
    {
        $form = new Form;

        $form->debutForm('post', '/contact/valid')
        ->ajoutLabelFor('prenom', 'Prénom :')
        ->ajoutInput('text', 'prenom', ['class' => 'form-control mb-3', 'id' => 'prenom', 'required' => 'true'])
        ->ajoutLabelFor('nom', 'Nom :')
        ->ajoutInput('text', 'nom', ['class' => 'form-control mb-3', 'id' => 'nom', 'required' => 'true'])
        ->ajoutLabelFor('email', 'Email :')
        ->ajoutInput('email', 'email', ['class' => 'form-control mb-3', 'id' => 'email', 'required' => 'true'])
        ->ajoutLabelFor('message', 'Message :')
        ->ajoutTextarea('message', '', ['class' => 'form-control mb-3', 'id' => 'message', 'rows' => 5, 'required' => 'true'])

        ->ajoutBouton("Envoyer", ['class' => 'btn btn-primary w-100 mt-3'])
        ->finForm();

        $this->render('contact/index', [
            'form' => $form->create()
        ]);
    }

    public function valid()
    {
        $mailer = new Mailer;
        $post = new Post;
        $validation = new Validation;

        $from = strip_tags($post->getPost('prenom')) . ' ' . strip_tags($post->getPost('nom'));
        $to = strip_tags($post->getPost('email'));
        $description = strip_tags($post->getPost('message'));

        $valid = $validation->contactValid($to, $post->getAllPost(), $description);

        if($valid !== true)
        {
            $this->alert('danger', $valid);
            header('Location: /contact');
        }else{
            $mailer->sendRequest($from, $description, $to);
            $mailer->sendConfirmationContact($from, $to);
    
            $this->alert('success', 'Votre message a bien été envoyé !');
            header('Location: /contact');
        }
    }
}