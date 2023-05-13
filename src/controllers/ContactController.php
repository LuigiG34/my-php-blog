<?php

namespace App\Controllers;

use App\Config\Post;
use App\Core\Form;
use App\Core\Mailer;
use App\Validation\Validation;


class ContactController extends Controller
{
    protected $mailer;
    protected $post;
    protected $form;
    protected $validation;

    
    public function __construct()
    {
        $this->mailer = new Mailer;
        $this->post = new Post;
        $this->form = new Form;
        $this->validation = new Validation;
    }


    public function index()
    {
        $this->form->debutForm('post', '/contact/valid')
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

        return $this->render('contact/index', [
            'form' => $this->form->create()
        ]);
    }

    
    public function valid()
    {

        $from = strip_tags($this->post->getPost('prenom')) . ' ' . strip_tags($this->post->getPost('nom'));
        $email = strip_tags($this->post->getPost('email'));
        $description = strip_tags($this->post->getPost('message'));

        $valid = $this->validation->contactValid($email, $this->post->getAllPost(), $description);

        if($valid !== true)
        {
            $this->alert('danger', $valid);
            header('Location: /contact');
        }

        $this->mailer->sendRequest($from, $description, $email);
        $this->mailer->sendConfirmationContact($from, $email);
    
        $this->alert('success', 'Votre message a bien été envoyé !');
        header('Location: /contact');
    }
}