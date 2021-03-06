<?php

namespace App\Form;

use App\Entity\Experiences;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\Type\DatePickerType;

class ExperiencesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DatePickerType::class, [
                'label' => 'Start Date'
            ])
            ->add('endDate', DatePickerType::class, [
                'label' => 'Birthday',
            ])
            ->add('context')
            ->add('action')
            ->add('results')
            ->add('technicalEnvironments')
            //->add('creationDate')
            ->add('active')
            ->add('idOrder')
            ->add('idLabel')
            ->add('idBusinessName')
            ->add('idCv')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experiences::class,
        ]);
    }
}
