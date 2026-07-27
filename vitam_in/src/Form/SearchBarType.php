<?php

namespace App\Form;


use App\Entity\SupplementType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class SearchBarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('query', SearchType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Ex: Vitamine C, énergie, someil..',
                ],
                'constraints' => [
                    new NotBlank(
                        message: 'Veuillez saisir un terme de recherche.'
                    ),
                ]
            ])
            ->add('tipo', EntityType::class, [
                'class' => SupplementType::class,
                'choice_label' => 'name', 
                'placeholder' => 'filtre par type ',
                'required' => false,
                'label' => 'Tipo',
            ]);
           
    }

   

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
