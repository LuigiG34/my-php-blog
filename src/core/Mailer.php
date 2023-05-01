<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Exception;

/**
 * Mailer class
 */
class Mailer 
{
    private $mail;

    public function __construct(){

        $this->mail = new PHPmailer(true);
        $config = parse_ini_file(ROOT . '/config.ini');

        // $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail->isSMTP();
        $this->mail->Host       = $config['MAIL_HOST'];
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = $config['MAIL_USERNAME'];
        $this->mail->Password   = $config['MAIL_PASSWORD'];
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port       = 587;

        $this->mail->setFrom($config['MAIL_USERNAME'], 'Blog Luigi Gandemer');
        $this->mail->CharSet = 'UTF-8';
    }

    /**
     * Reset password email
     *
     * @param string $to
     * @param string $link
     */
    public function resetPassword(string $to, string $link){

        $this->mail->addAddress($to);

        $this->mail->Subject = 'Mettez à jour votre mot de passe';
        $this->mail->Body = "Veuillez vous rendre à l'adresse suivante pour mettre à jour votre mot de passe : $link";

        if(!$this->mail->send()){
            throw new Exception("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }

    /**
     * Reset password email
     *
     * @param string $to
     * @param string $link
     */
    public function sendRequest(string $from, string $description){

        $config = parse_ini_file(ROOT . '/config.ini');
        $this->mail->setFrom($config['MAIL_USERNAME'], 'Blog Luigi Gandemer');
        $this->mail->addAddress('contact@luigigandemer.fr');

        $this->mail->Subject = $from . ' vous a envoyé un message via le site Luigi Gandemer Blog.';
        $this->mail->Body = $description;

        if(!$this->mail->send()){
            throw new Exception("Votre message n'a pas pu être envoyé. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }

    public function sendConfirmationContact(string $to){

        $config = parse_ini_file(ROOT . '/config.ini');
        $this->mail->setFrom($config['MAIL_USERNAME'], 'Luigi Gandemer Blog');

        $this->mail->addAddress($to);

        $this->mail->Subject = "Confirmation de l'envoi de votre demande de contact sur le site Luigi Gandemer Blog.";

        $this->mail->Body = "<p>Bonjour ". $to ."</p>";
        $this->mail->Body .= "<p>Nous avons bien reçu votre demande de contact. Vous recevrez une réponse sous 72 heures.</p>";
        $this->mail->Body .= "<p>Cordialement,</p>";
        $this->mail->Body .= "<div><img style='height: 100%;min-width:50px; max-width: 250px;' src='https://i.ibb.co/LPH83Vt/Luigi-Gandemer-Freelance-Web-Dev.png'>";
        $this->mail->isHTML(true);

        $this->mail->AltBody = "Bonjour,";
        $this->mail->AltBody .= "Nous avons bien reçu votre demande de contact. Vous recevrez une réponse sous 72 heures.";
        $this->mail->AltBody .= "Cordialement,";
        $this->mail->AltBody .= "Luigi Gandemer";


        if(!$this->mail->send()){
            throw new Exception("Notre mail de confirmation n'a pas pu être envoyé. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }


    public function sendConfirmationSignUp(string $to)
    {
        $config = parse_ini_file(ROOT . '/config.ini');
        $this->mail->setFrom($config['MAIL_USERNAME'], 'Luigi Gandemer Blog');

        $this->mail->addAddress($to);

        $this->mail->Subject = "Confirmation d'inscription sur le site Luigi Gandemer Blog.";

        $this->mail->Body = "<p>Bonjour ". $to ."</p>";
        $this->mail->Body .= "<p>Nous confirmons votre inscription au site de Luigi Gandemer - Blog.</p>";
        $this->mail->Body .= "<p>Cordialement,</p>";
        $this->mail->Body .= "<div><img style='height: 100%;min-width:50px; max-width: 250px;' src='https://i.ibb.co/LPH83Vt/Luigi-Gandemer-Freelance-Web-Dev.png'>";
        $this->mail->isHTML(true);

        $this->mail->AltBody = "Bonjour,";
        $this->mail->AltBody .= "Nous confirmons votre inscription au site de Luigi Gandemer - Blog.";
        $this->mail->AltBody .= "Cordialement,";
        $this->mail->AltBody .= "Luigi Gandemer";


        if(!$this->mail->send()){
            throw new Exception("Notre mail de confirmation n'a pas pu être envoyé. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }
}