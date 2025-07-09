<?php

namespace App\Controller\Back;

use App\Form\PdfUpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MenuController extends AbstractController
{
    #[Route('/backoffice/gestion-menu', name: 'back_menu_upload')]
    public function upload(Request $request): Response
    {
        $form = $this->createForm(PdfUpdateType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          dd('Soumis ?', $form->isValid(), $form->getErrors(true));
            $pdfFile = $form->get('pdf')->getData();

            if ($pdfFile) {
                try {
                    // Écraser l’ancien fichier avec le nouveau, toujours le même nom
                    $pdfFile->move(
                        $this->getParameter('kernel.project_dir') . '/public/ressources/',
                        'Menu_Matcha_Bloom.pdf'
                    );
                    $this->addFlash('success', 'Le document PDF a été mis à jour.');
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors du téléchargement du fichier.');
                }
            }

            return $this->redirectToRoute('back_menu_upload');
        }

        return $this->render('back/menu/upload_menu.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}