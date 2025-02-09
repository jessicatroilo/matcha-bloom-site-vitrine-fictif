<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(): Response
    {
        return $this->render('menu/carte.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }
}
