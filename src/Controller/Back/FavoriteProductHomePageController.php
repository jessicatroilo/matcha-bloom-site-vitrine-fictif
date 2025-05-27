<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ProductHomeService;

#[Route('/admin/produits-favoris-accueil', name: 'app_back_favorite_product_')]
final class FavoriteProductHomePageController extends AbstractController
{
    /**
     * Affiche la liste des produits favoris sur la page d'accueil.
     *
     * @return Response La réponse contenant la vue avec les produits favoris de la page d'accueil.
     */
    #[Route('/', name:'list', methods: ['GET'])]
    public function list(): Response
    {
        // On peut récupérer les produits favoris depuis le service ProductHomeService
        $productHomeService = new ProductHomeService();
        try {
            $favoriteProducts = $productHomeService->getProducts();
        } catch (\Exception $e) {
            // Gérer l'exception si le fichier n'est pas trouvé ou s'il y a une erreur
            $this->addFlash('error', 'Erreur lors de la récupération des produits : ' . $e->getMessage());
            $favoriteProducts = [];
        }
        // On peut passer les produits à la vue pour les afficher
        return $this->render('back/home_page_matcha/list.html.twig', [
            'controller_name' => 'FavoriteProductHomePageController',
            'favoriteProducts' => $favoriteProducts,
        ]);
    }

    #[Route ('/{id}', name:'show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(int $id, ProductHomeService $productHomeService): Response
    {
        try {
            $products = $productHomeService->getProducts();

            $oneFavProduct = null;

            foreach ($products as $product) {
                if ($product['id'] === $id) {
                    $oneFavProduct = $product;
                    break;
                }
            }

            if (!$oneFavProduct) {
                throw $this->createNotFoundException("Produit avec l'id {$id} non trouvé.");
            }

        } catch (\Exception $e) {
            $this->addFlash('error', 'Erreur lors de la récupération du produit : ' . $e->getMessage());
            throw $this->createNotFoundException('Erreur système');
        }

        return $this->render('back/home_page_matcha/show.html.twig', [
            'oneFavProduct' => $oneFavProduct,
        ]);
    }
}
