<?php

namespace App\Form;

use App\Entity\UserSupplement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserSupplementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dosageScheduleDose', NumberType::class, [
                'property_path' => 'dosage_schedule[dose]',
                'label' => 'Dosage',
                'attr' => [
                   'min' => 0,       
                ],
               
            ])
           ->add('start_date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début',
            ])
            ->add('duration_days', IntegerType::class, [
                'label' => 'Durée (jours)',
                'attr' => [
                    'min' => 1,
                    'step' => 1,
                ],
            ])
            ->add('google_calendar', CheckboxType::class, [
                'label' => 'Ajouter automatiquement cette prise à mon agenda Google',
                'mapped' => false,   
                'required' => false,  
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserSupplement::class,
        ]);
    }
}
