<?php 
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(string $from, string $to, string $subject, string $content, string $replyTo = null)
    {
        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->text($content);
            if ($replyTo) {
                $email->replyTo($replyTo);
            }

        $this->mailer->send($email);
    }
}