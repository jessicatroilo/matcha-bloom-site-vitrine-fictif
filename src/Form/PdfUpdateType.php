<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class PdfUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pdf', FileType::class, [
                'label' => 'Remplacer le PDF du menu ',
                'mapped' => false,
                'required' => true,
                'translation_domain' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4M',
                        'maxSizeMessage' => 'Le fichier PDF ne doit pas dépasser 4 Mo.',
                        'mimeTypes' => ['application/pdf'],
                        'mimeTypesMessage' => 'Merci de téléverser un PDF valide.',
                        'mimeTypes' => ['application/pdf'],
                        'mimeTypesMessage' => 'Seuls les fichiers PDF sont autorisés.',
                    ])
                ],
            ]);
    }
}

