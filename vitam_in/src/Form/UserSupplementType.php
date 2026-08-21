<?php

namespace App\Form;

use App\Entity\Supplement;
use App\Entity\User;
use App\Entity\UserSupplement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserSupplementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('dosage_schedule')
            // ->add('start_date', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('duration_days')
            // ->add('precautions')
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
            ->add('supplement', EntityType::class, [
                'class' => Supplement::class,
                'choice_label' => 'name',
            ])
        ;
    }

            // $builder
            // ->add('start_date', DateType::class, [
            //     'widget' => 'single_text',
            //     'label' => 'Fecha de inicio',
            // ])
            // ->add('duration_days', IntegerType::class, [
            //     'label' => 'Duración (días)',
            // ])
            // ->add('dosage_schedule', TextareaType::class, [
            //     'label' => 'Pauta de dosis',
            //     'help' => 'Ejemplo: "Mañana: 1 comprimido, Noche: 2 comprimidos"',
            //     // Para simplificar, lo manejamos como texto; luego convertimos a array o lo guardamos como JSON.
            // ])
//             $builder->add('dosage_schedule', JsonType::class, [
//     'label' => 'Pauta de dosis',
// ]);
            // ->add('precautions', TextareaType::class, [
            //     'label' => 'Precauciones',
            //     'required' => false,
            // ]);

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserSupplement::class,
        ]);
    }
}
