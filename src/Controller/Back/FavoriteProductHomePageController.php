<?php

namespace App\Controller\Back;

use App\DTO\FavProductDTO;
use App\Form\FavoriteProductType;
use App\Service\ProductHomeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
            'favoriteProducts' => $favoriteProducts,
        ]);
    }

    /**
     * Affiche les détails d'un produit favori spécifique.
     *
     * @param int $id L'identifiant du produit à afficher.
     * @param ProductHomeService $productHomeService Le service pour récupérer les produits.
     * @return Response La réponse contenant la vue avec les détails du produit.
     */
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

    /**
     * Met à jour un produit favori spécifique.
     *
     * @param int $id L'identifiant du produit à mettre à jour.
     * @param ProductHomeService $productHomeService Le service pour récupérer et sauvegarder les produits.
     * @param Request $request La requête HTTP contenant les données du formulaire.
     * @return Response La réponse contenant la vue avec le formulaire de mise à jour.
     */
    #[Route('/{id}/modifier', name: 'update', methods: ['GET','POST'], requirements: ['id' => '\d+'])]
    public function update(int $id, ProductHomeService $productHomeService, Request $request): Response
    {
        // Étape 1 : Chargement de tous les produits depuis le fichier JSON
        try {
            $products = $productHomeService->getProducts();
        } catch (\Exception $e) {
            // Si le fichier est introuvable ou corrompu, on affiche une erreur
            $this->addFlash('error', 'Erreur lors du chargement des produits : ' . $e->getMessage());
            throw $this->createNotFoundException('Erreur système'); // Message de secours
        }

        // Étape 2 : Recherche du produit correspondant à l’ID
        $favProductData = null;
        foreach ($products as $product) {
            if ((int) $product['id'] === $id) {
                $favProductData = $product;
                break;
            }
        }

        // Produit introuvable
        if (!$favProductData) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        // Étape 3 : Création d’un DTO rempli avec les données du produit
        $favProductDTO = new FavProductDTO();
        $favProductDTO->id = $favProductData['id'];
        $favProductDTO->name = $favProductData['name'];
        $favProductDTO->description = $favProductData['description'];
        $favProductDTO->image = $favProductData['image'];
        $favProductDTO->classe_css = $favProductData['classe_css']; 


        // Étape 4 : Création du formulaire
        $form = $this->createForm(FavoriteProductType::class, $favProductDTO);
        $form->handleRequest($request);

        // Étape 5 : Si le formulaire est soumis ET valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Étape 5.1 : Récupération des données du formulaire
            $formData = $form->getData();

            // Étape 5.2 : Gérer l'upload de l’image
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('produits_directory'), // paramètre défini dans services.yaml
                        $newFilename
                    );

                    // On met à jour le champ image dans l'objet DTO
                    $formData->image = '/uploads/produits/' . $newFilename;
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l’upload de l’image.');
                    // Tu peux soit abandonner ici, soit garder l’ancienne image
                    $formData->image = $favProductData['image'];
                }
            } else {
                // Si pas de nouvelle image, garder l’ancienne image dans l'objet DTO
                $formData->image = $favProductData['image'];
            }

            // Étape 6 : Mise à jour du produit dans le tableau complet
            
            // On parcourt la liste complète des produits pour trouver celui à modifier
            foreach ($products as $index => $existingProduct) {
            // Si l'ID du produit correspond à celui qu'on souhaite modifier
            if ((int) $existingProduct['id'] === $id) {

                // On met à jour les données du produit à cet index avec les nouvelles valeurs
                $products[$index] = [
                    'id' => $formData->id,                      // ID (non modifiable mais on le garde ici pour cohérence)
                    'name' => $formData->name,                  // Nouveau nom
                    'description' => $formData->description,    // Nouvelle description
                    'image' => $formData->image,                // Nouvelle image (ou l'ancienne si pas changée)
                    'classe_css' => $existingProduct['classe_css'], // Optionnel : on garde l'ancienne classe si non modifiable
                ];

            // On sort de la boucle dès qu'on a trouvé et modifié le bon produit
            break;
            }
}

            // Étape 7 : Sauvegarde du fichier JSON
            try {
                $productHomeService->saveProducts($products); // Méthode à créer dans le service
                $this->addFlash('success', 'Produit modifié avec succès');

                // Redirection vers la liste (ou une autre route)
                return $this->redirectToRoute('app_back_favorite_product_list');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Impossible d’enregistrer les modifications : ' . $e->getMessage());
            }
        }

        // Étape 8 : Affichage du formulaire avec les données du produit
        return $this->render('back/home_page_matcha/update.html.twig', [
            'form' => $form->createView(),
            'updatedFavProduct' => $favProductDTO,
        ]);
    }
}
