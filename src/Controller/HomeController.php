<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ProductHomeService;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductHomeService $productHomeService): Response
    {
        $productsInHomePage = $productHomeService->getProducts();

        return $this->render('home/index.html.twig', [
            'products' => $productsInHomePage,
        ]);
    }

}