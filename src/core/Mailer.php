<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Exception;

/**
 * Mailer file
 *
 * PHP Version 8.0
 *
 * @category PHP
 * @package  Openclassrooms_P5_Blog
 * @author   Luigi Gandemer <luigigandemer6@gmail.com>
 * @license  MIT Licence
 */
class Mailer
{
    private PHPMailer $mail;
    private $config;

    public function __construct()
    {

        $this->mail = new PHPmailer(true);
        $this->config = parse_ini_file(ROOT . '/config.ini');

        $this->mail->isSMTP();
        $this->mail->Host       = $this->config['MAIL_HOST'];
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = $this->config['MAIL_USERNAME'];
        $this->mail->Password   = $this->config['MAIL_PASSWORD'];
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port       = 587;

        $this->mail->setFrom($this->config['MAIL_USERNAME'], 'Blog Luigi Gandemer');
        $this->mail->CharSet = 'UTF-8';
    }


    /**
     * resetPassword function
     *
     * @param string $to The recipient's email address
     * @param string $link The password reset link
     * 
     * @throws Exception If the email could not be sent
     * 
     * @return void
     */
    public function resetPassword(string $to, string $link): void
    {

        $this->mail->addAddress($to);

        $this->mail->Subject = 'Mettez à jour votre mot de passe';
        $this->mail->Body = "Veuillez vous rendre à l'adresse suivante pour mettre à jour votre mot de passe : $link";

        if (!$this->mail->send()) {
            throw new Exception("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }


    /**
     * sendRequest function
     *
     * @param string $from
     * @param string $description
     * @param string $email
     * 
     * @throws Exception if the email cannot be sent.
     * 
     * @return void
     */
    public function sendRequest(string $from, string $description, string $email): void
    {

        $this->mail->setFrom($this->config['MAIL_USERNAME'], 'Blog Luigi Gandemer');
        $this->mail->addAddress('contact@luigigandemer.fr');

        $this->mail->Subject = $from . ' vous a envoyé un message via le site Luigi Gandemer Blog.';
        $this->mail->Body = 'Email : ' . $email . ' ';
        $this->mail->Body .= 'Message : ' . $description;

        if (!$this->mail->send()) {
            throw new Exception("Votre message n'a pas pu être envoyé. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }


    /**
     * sendConfirmationContact function
     *
     * @param string $from
     * @param string $to
     * 
     * @throws Exception if the email could not be sent.
     * 
     * @return void
     */
    public function sendConfirmationContact(string $from, string $to): void
    {
        $this->mail->setFrom($this->config['MAIL_USERNAME'], 'Luigi Gandemer Blog');

        $this->mail->addAddress($to);

        $this->mail->Subject = "Confirmation de l'envoi de votre demande de contact sur le site Luigi Gandemer Blog.";

        $this->mail->Body = "<p>Bonjour " . $from . "</p>";
        $this->mail->Body .= "<p>Nous avons bien reçu votre demande de contact. Vous recevrez une réponse sous 72 heures.</p>";
        $this->mail->Body .= "<p>Cordialement,</p>";
        $this->mail->Body .= "<div><img style='height: 100%;min-width:50px; max-width: 250px;' src='https://i.ibb.co/LPH83Vt/Luigi-Gandemer-Freelance-Web-Dev.png'>";
        $this->mail->isHTML(true);

        $this->mail->AltBody = "Bonjour,";
        $this->mail->AltBody .= "Nous avons bien reçu votre demande de contact. Vous recevrez une réponse sous 72 heures.";
        $this->mail->AltBody .= "Cordialement,";
        $this->mail->AltBody .= "Luigi Gandemer";


        if (!$this->mail->send()) {
            throw new Exception("Notre mail de confirmation n'a pas pu être envoyé. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }


    /**
     * sendConfirmationSignUp function
     *
     * @param string $to
     * 
     * @throws Exception if the email could not be sent.
     * 
     * @return void
     */
    public function sendConfirmationSignUp(string $to): void
    {
        $this->mail->setFrom($this->config['MAIL_USERNAME'], 'Luigi Gandemer Blog');

        $this->mail->addAddress($to);

        $this->mail->Subject = "Confirmation d'inscription sur le site Luigi Gandemer Blog.";

        $this->mail->Body = "<p>Bonjour " . $to . "</p>";
        $this->mail->Body .= "<p>Nous confirmons votre inscription au site de Luigi Gandemer - Blog.</p>";
        $this->mail->Body .= "<p>Cordialement,</p>";
        $this->mail->Body .= "<div><img style='height: 100%;min-width:50px; max-width: 250px;' src='https://i.ibb.co/LPH83Vt/Luigi-Gandemer-Freelance-Web-Dev.png'>";
        $this->mail->isHTML(true);

        $this->mail->AltBody = "Bonjour,";
        $this->mail->AltBody .= "Nous confirmons votre inscription au site de Luigi Gandemer - Blog.";
        $this->mail->AltBody .= "Cordialement,";
        $this->mail->AltBody .= "Luigi Gandemer";


        if (!$this->mail->send()) {
            throw new Exception("Notre mail de confirmation n'a pas pu être envoyé. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }
}
