<?php

namespace App\Form\FormExtension;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RepeatedPasswordType extends AbstractType
{
    public function getParent()
    {
        return RepeatedType::class; // TODO: Change the autogenerated stub
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults( [
            'label' => 'Confirmation',
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'type' => PasswordType::class,
            'attr' => [
                'autocomplete' => 'new-password',
                'class' => 'password-field'
            ],
            'first_options' => ['label' => 'Mot de passe'],
            'second_options' => ['label' => 'Confirmation'],
            'invalid_message' => 'Vous avez saisi deux mots de passe differents.',
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir le mot de passe',
                ]),
                new Length([
                    'min' => 8,
                    'minMessage' => 'Votre mot de passe doit avoir un minimum de {{ limit }} caracteres',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ]
        ]);
    }
}