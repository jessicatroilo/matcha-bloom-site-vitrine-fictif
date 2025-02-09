<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', name: 'app_')]
final class MiscController extends AbstractController
{
    #[Route('mentions-legales', name: 'legal_notice')]
    public function legalNotice(): Response
    {
        return $this->render('misc/legal-notice.html.twig', [
            'controller_name' => 'MiscController',
        ]);
    }

    #[Route('politique-confidentialité', name: 'confidentiality_policy')]
    public function confidentialityPolicy(): Response
    {
        return $this->render('misc/confidentiality-policy.html.twig', [
            'controller_name' => 'MiscController',
        ]);
    }

}
