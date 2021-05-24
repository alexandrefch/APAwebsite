<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',null, [
                'attr' => [
                    'autocomplete' => 'given-name',
                    'placeholder'=>'Michel'
                ],
                'label' => 'Prénom',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un prénom',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre prénom doit faire plus de 3 caractères',
                        'max' => 45,
                        'maxMessage' => 'Votre prénom doit faire moins de 45 caractères',
                    ]),
                ]
            ])
            ->add('lastName',null, [
                'attr' => [
                    'autocomplete' => 'family-name',
                    'placeholder'=>'Dupont'
                ],
                'label' => 'Nom de famille',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un nom de famille',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre nom de famille doit faire plus de 3 caractères',
                        'max' => 45,
                        'maxMessage' => 'Votre nom de famille doit faire moins de 45 caractères',
                    ]),
                ]
            ])
            ->add('email',EmailType::class , [
                'attr' => [
                    'autocomplete' => 'email',
                    'placeholder'=>'mdupont1@mail.fr'
                ],
                'label' => 'Email',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un email',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre email doit faire plus de 6 caractères',
                        'max' => 180,
                        'maxMessage' => 'Votre nom de famille doit faire moins de 180 caractères',
                    ]),
                ]
            ])
            ->add('plainPassword',PasswordType::class, [
                'mapped' => false,
                'label' => 'Mot de passe',
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder'=>'************'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entre un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('phoneNumber',TelType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'autocomplete' => 'tel',
                    'placeholder'=>'0694328027'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entre un numéro de téléphone',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au numéro de téléphone {{ limit }} caractères',
                        'max' => 15,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
