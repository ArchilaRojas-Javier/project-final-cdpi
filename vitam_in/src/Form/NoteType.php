<?php

namespace App\Form;

use App\Entity\Note;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;


class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => false,  
                'attr' => [
                    'placeholder' => "Ex: Bien dormi, moins de stress, ou... aucun effet pour l'instant.",
                    'rows' => 5,
                    'class' => 'w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none',
                ],
                'constraints' => [
                        new NotBlank(
                            message: 'Veuillez entrer un mot de passe',
                        )
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
