<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerService $mailerService): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Envoyer l'email
            $mailerService->sendEmail(
                'jessica.troilo25@gmail.com', // Expéditeur (obligatoire pour Gmail)
               // Sinon  $data['email'],  // L'email de l'expéditeur (le visiteur)
                'jessica.troilo25@gmail.com',  // Ton adresse Gmail
                'Nouveau message de contact',
                "Nom: {$data['name']}\nEmail: {$data['email']}\nMessage: {$data['message']}",
                $data['email'] // Reply-To (permet de répondre au visiteur) (avec Gmail)
            );

            $this->addFlash('success', 'Votre message a bien été envoyé.');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
