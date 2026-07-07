<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                new Assert\NotBlank(),
                new Assert\Email(
                    message: "L'adresse email {{ value }} n'est pas valide.",
                ),
            ]])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue(
                        message: 'You should agree to our terms.',
                    ),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Les mots de passe doivent correspondre.',
                'options' => ['attr' => ['autocomplete' => 'new-password']],
                'required' => true,
                'first_options' => [
                    'label' => 'mot de passe',
                    'constraints' => [
                        new NotBlank(
                            message: 'Please enter a password',
                        ),
                        new Length(
                            min: 8,
                            minMessage: 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            max: 4096,
                        ),
                        new Regex(
                            pattern: '/^[A-Za-z\d]+$/',
                            message: 'La contraseña debe contener al menos una letra y un número.',
                        ),
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmer mot de passe',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
