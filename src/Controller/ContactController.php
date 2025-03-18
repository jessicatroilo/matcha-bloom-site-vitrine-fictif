<?php

namespace App\Controller;

use Exception;
use App\Form\ContactType;
use App\Service\MailerService;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface; // Ajouter l'importation

class ContactController extends AbstractController
{

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerService $mailerService): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            // Envoyer l'email + gestion des erreurs
            try {
            // avec Email()
            /* $mailerService->sendEmail(
                'jessica.troilo25@gmail.com', // Expéditeur (obligatoire pour Gmail)
               // Sinon  $data['email'],  // L'email de l'expéditeur (le visiteur)
                'jessica.troilo25@gmail.com',  // Ton adresse Gmail
                "Nouveau message de {$data['name']} - sujet: {$data['subject']}",
                "Nom: {$data['name']}\nEmail: {$data['email']}\nMessage: {$data['message']}",
                $data['email'] // Reply-To (permet de répondre au visiteur) (avec Gmail)
                
            );  */ 

            //Avec TemplatedEmail()
            // Envoi de l'email avec le template Twig
            $mailerService->sendEmail(
                $data['email'],   // Email de l'expéditeur (le visiteur)
                $data['name'],    // Nom de l'expéditeur
                $data['message'], // Message du formulaire
                $data['subject']  // Sujet du message
            );

            // Message de confirmation d'envoi
            $this->addFlash('success', 'Votre message a bien été envoyé.');

            //Redirection vers la page de contact
            return $this->redirectToRoute('app_contact');

            } catch (Exception $e) {
                 // Affichage du message d'erreur détaillé dans les logs
                 $this->logger->error('Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());

                // Message d'erreur
                $this->addFlash('error', 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer plus tard.');
            }
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
