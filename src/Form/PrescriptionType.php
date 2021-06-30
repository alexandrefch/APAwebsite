<?php

namespace App\Form;

use App\Entity\Prescription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrescriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('goal')
            ->add('creation_date')
            ->add('duration')
            ->add('min_time_sport_week')
            ->add('max_time_sport_week')
            ->add('doctor')
            ->add('patient')
            ->add('contraindication')
            ->add('cure')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prescription::class,
        ]);
    }
}
