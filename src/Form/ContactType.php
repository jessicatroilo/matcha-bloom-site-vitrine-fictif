<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
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
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le nom ne peut pas être vide.',
                    ]),
                    new Assert\Length([
                        'max' => 100,
                        'min' => 2,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-ZÀ-ÿ -]+$/', // Permet uniquement des lettres, des accents, des espaces et des tirets
                        'message' => 'Le nom ne peut contenir que des lettres, des accents, des espaces et des tirets.',
                    ]),
                ]
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
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'L\'adresse email ne peut pas être vide.',
                    ]),
                    new Assert\Email([
                        'message' => 'L\'adresse email {{ value }} n\'est pas valide.',
                    ]),
                    new Assert\Length([
                        'max' => 100,
                        'min'=> 5,
                        'minMessage' => 'L\'adresse email doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'L\'adresse email ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
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
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le sujet ne peut pas être vide.',
                    ]),
                    new Assert\Choice([
                        'choices' => ['Question générale', 'Demande d\'informations', 'Réservation', 'Autre'],
                        'message' => 'Le sujet n\'est pas valide.',
                    ]),
                ],
            ])

            ->add('message', TextareaType::class, [
                'label' => 'Message *',
                'label_attr' => [
                    'class' => 'form-label',
                    'aria-label' => 'Message (champ obligatoire)',
                ],
                'attr' => ['class' => 'form-input', 'rows' => 4],
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le message ne peut pas être vide.',
                    ]),
                    new Assert\Length([
                        'max' => 1000,
                        'min' => 5,
                        'minMessage' => 'Le message doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le message ne peut pas dépasser {{ limit }} caractères.',
                        
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'form-btn',
                    'aria-label' => 'Bouton pour envoyer le message',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => true, // Assure que CSRF est activé
            'csrf_field_name' => '_token', // Le nom du champ CSRF
            'csrf_token_id' => 'contact_form', // Identifiant du token
        ]);
    }
}