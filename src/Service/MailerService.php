<?php 
namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailerService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

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
            ->from(new Address('jessica.troilo25@gmail.com', 'Jessica')) // Ajout d'un nom d'expéditeur
            ->to(new Address('jessica.troilo25@gmail.com'))
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

