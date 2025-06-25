<?php 
namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;


class MailerService
{
    private $mailer;
    /**
     * Constructeur de la classe MailerService
     *
     * @param MailerInterface $mailer L'interface du service de messagerie
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    /**
     * Envoi un email à l'utilisateur et à l'administrateur du site
     *
     * @param string $userEmail L'adresse email de l'utilisateur
     * @param string $userName Le nom de l'utilisateur
     * @param string $message Le message de l'utilisateur
     * @param string $subject Le sujet de l'email
     * @return void
     */
    public function sendEmail(string $userEmail, string $userName, string $message, string $subject)// avec Email() string $from, string $to, string $subject, string $content, string $replyTo = null
    {
        /* $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->text($content);
            if ($replyTo) {
                $email->replyTo($replyTo);
            } */

            $email = (new TemplatedEmail())
            ->from(new Address('votre-adresse-mail@monemail.fr', 'Votr nom')) // Ajout d'un nom d'expéditeur // ->from($from) pour Gmail mettre son adresse mail
            ->to(new Address('votre-adresse-mail@monemail.fr'))
            ->replyTo($userEmail) // Permet de répondre directement au visiteur
            ->subject($subject)
            ->htmlTemplate('emails/contact.html.twig') // Fichier Twig à utiliser
            ->context([
                'name' => $userName,
                'sender_email' => $userEmail,
                'message' => $message,
            ]);

        $this->mailer->send($email);
    }
}

