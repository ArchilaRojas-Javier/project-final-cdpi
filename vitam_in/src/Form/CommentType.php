<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length; 

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => false,  
                'attr' => [
                    'placeholder' => "Votre retour aidera d'autres utilisateurs à faire leur choix..",
                    'rows' => 5,
                    'class' => 'w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none',
                    'maxlength' => 500                
                ],
                'constraints' => [
                        new NotBlank(
                            message: 'Veuillez entrer un note',
                        ),
                        new Length(
                            max: 500,
                            maxMessage: 'Le commentaire ne peut pas dépasser {{ limit }} caractères',
                        ),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
