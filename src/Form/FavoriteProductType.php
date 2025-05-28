<?php
namespace App\Form;

use App\DTO\FavProductDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FavoriteProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom du produit'])
            ->add('description', TextType::class, ['label' => 'Description'])
            //->add('classe_css', TextType::class, ['label' => 'Classe CSS']) 
            ->add('image', FileType::class, [
                'label' => 'Nouvelle image',
                'mapped' => false,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FavProductDTO::class,
        ]);
    }
}