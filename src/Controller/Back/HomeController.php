<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/admin', name: 'app_back_admin')]
    public function index(): Response
    {
        return $this->render('back/backoffice.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
