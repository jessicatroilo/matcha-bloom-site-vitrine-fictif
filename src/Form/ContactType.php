<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom *',
                'label_attr' => [
                    'class' => 'form-label',
                    'aria-label' => 'Nom (champ obligatoire)',
                ],
                'attr' => ['class' => 'form-input', 'size' => 10],
                'required' => true,
            ])

            ->add('email', EmailType::class, [
                'label' => 'Adresse email *',
                'label_attr' => [
                    'class' => 'form-label',
                    'aria-label' => 'Adresse mail (champ obligatoire)',
                ],
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-input', 'size' => 50],
                'required' => true,
            ])

            ->add('subject', ChoiceType::class, [
                'label' => 'Sujet *',
                'label_attr' => [
                    'class' => 'form-label',
                    'aria-label' => 'Sujet (champ obligatoire)',
                ],
                'choices' => [
                    'Question générale' => 'Question générale',
                    'Demande d\'informations' => 'Demande d\'informations',
                    'Réservation' => 'Réservation',
                    'Autre' => 'Autre',
                ],
                'attr' => ['class' => 'form-input'],
                'required' => true,
            ])

            ->add('message', TextareaType::class, [
                'label' => 'Message *',
                'label_attr' => [
                    'class' => 'form-label',
                    'aria-label' => 'Message (champ obligatoire)',
                ],
                'attr' => ['class' => 'form-input', 'rows' => 4],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'form-btn',
                    'aria-label' => 'Bouton pour envoyer le message',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}