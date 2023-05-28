<?php

namespace App\Core;

use App\Entity\Utilisateur;
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
    private $mainPath;

    public function __construct()
    {

        $this->mail = new PHPmailer(true);
        $this->config = parse_ini_file(ROOT . '/config.ini');

        $this->mail->isSMTP();
        $this->mail->Host       = $this->config['MAIL_HOST'];
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = $this->config['MAIL_USERNAME'];
        $this->mail->Password   = $this->config['MAIL_PASSWORD'];
        $this->mail->Port       = $this->config['MAIL_PORT'];

        $this->mail->setFrom($this->config['MAIL_FROM_ADDRESS'], $this->config['MAIL_FROM_NAME']);
        $this->mail->CharSet = 'UTF-8';
        $host = $_SERVER['HTTP_HOST'];
        $protocol=$_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
        $this->mainPath = $protocol . '://' . $host . '/';
    }


    /**
     * resetPassword function
     *
     * @param Utilisateur $user
     * 
     * @throws Exception If the email could not be sent
     * 
     * @return void
     */
    public function resetPassword(Utilisateur $user): void
    {
        
        $this->mail->addAddress($user->getEmail());

        $this->mail->Subject = '<p>Mettez à jour votre mot de passe</p>';
        $this->mail->Body = "<p>Veuillez vous rendre à l'adresse suivante pour mettre à jour votre mot de passe : <a href='".$this->mainPath."utilisateurs/newPassword/{$user->getTokenReset()}'>".$this->mainPath."utilisateurs/newPassword/{$user->getTokenReset()}</a>.</p>";
        $this->mail->isHTML(true);
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

        $this->mail->setFrom($this->config['MAIL_FROM_ADDRESS'], $this->config['MAIL_FROM_NAME']);
        $this->mail->addAddress($this->config['MAIL_NOTIFICATION_ADDRESS']);

        $this->mail->Subject = '<p>'. $from . ' vous a envoyé un message via le site Luigi Gandemer Blog.</p>';
        $this->mail->Body = '<p>Email : ' . $email . '</p>';
        $this->mail->Body .= '<p>Message : ' . $description . '</p>';
        $this->mail->isHTML(true);

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
        $this->mail->setFrom($this->config['MAIL_FROM_ADDRESS'], $this->config['MAIL_FROM_NAME']);

        $this->mail->addAddress($to);

        $this->mail->Subject = "Confirmation de l'envoi de votre demande de contact sur le site Luigi Gandemer Blog.";

        $this->mail->Body = "<p>Bonjour " . $from . "</p>";
        $this->mail->Body .= "<p>Nous avons bien reçu votre demande de contact. Vous recevrez une réponse sous 72 heures.</p>";
        $this->mail->Body .= "<p>Cordialement,</p>";
        $this->mail->Body .= "<div><img style='height: 100%;min-width:50px; max-width: 250px;' src='https://i.ibb.co/LPH83Vt/Luigi-Gandemer-Freelance-Web-Dev.png'>";
        $this->mail->isHTML(true);

        if (!$this->mail->send()) {
            throw new Exception("Notre mail de confirmation n'a pas pu être envoyé. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }


    /**
     * sendConfirmationSignUp function
     *
     * @param Utilisateur $user
     * 
     * @throws Exception if the email could not be sent.
     * 
     * @return void
     */
    public function sendConfirmationSignUp(Utilisateur $user): void
    {
        $this->mail->setFrom($this->config['MAIL_FROM_ADDRESS'], $this->config['MAIL_FROM_NAME']);

        $this->mail->addAddress($user->getEmail());

        $this->mail->Subject = "Confirmation d'inscription sur le site Luigi Gandemer Blog.";

        $this->mail->Body = "<p>Bonjour " . $user->getEmail()  . "</p>";
        $this->mail->Body .= "<p>Merci de valider votre email en cliquant sur ce lien : <a href='".$this->mainPath."utilisateurs/verify/{$user->getVerifToken()}'>".$this->mainPath."/confirm-email/{$user->getVerifToken()}</a>.</p>";
        $this->mail->Body .= "<p>Cordialement,</p>";
        $this->mail->Body .= "<div><img style='height: 100%;min-width:50px; max-width: 250px;' src='https://i.ibb.co/LPH83Vt/Luigi-Gandemer-Freelance-Web-Dev.png'>";
        $this->mail->isHTML(true);

        if (!$this->mail->send()) {
            throw new Exception("Notre mail de confirmation n'a pas pu être envoyé. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }
}
