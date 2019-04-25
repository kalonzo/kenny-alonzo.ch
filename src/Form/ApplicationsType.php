<?php

namespace App\Form;

use App\Entity\Applications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add('descn')
            ->add('creationDate')
            ->add('publishedAt')
            ->add('active')
            ->add('idLabel')
            ->add('idPortfolio')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Applications::class,
        ]);
    }
}
