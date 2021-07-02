<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class , [
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'email',
                    'placeholder'=>'patient@mail.fr'
                ],
                'label' => 'Email',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un email',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'L\'email doit faire plus de 6 caractères',
                        'max' => 180,
                        'maxMessage' => 'L\'email doit faire moins de 180 caractères',
                    ]),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
