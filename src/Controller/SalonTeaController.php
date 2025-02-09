<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SalonTeaController extends AbstractController
{
    #[Route('/notre-salon', name: 'app_salon_tea')]
    public function index(): Response
    {
        return $this->render('salon_tea/history.html.twig', [
            'controller_name' => 'SalonTeaController',
        ]);
    }
}
