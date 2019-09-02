<?php

namespace App\Form;

use App\Entity\Portfolios;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PortfoliosType extends AbstractType
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
            //->add('idHeader')
           // ->add('idNavbar')
           // ->add('idMenuContent')
            //->add('idWidget')
            //->add('idContent')
            //->add('idFooter')
            ->add('id')
            //->add('idApp')
            ->add('idCv')
            //->add('idGallery')
            //->add('idProject')
            //->add('idWeb')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Portfolios::class,
        ]);
    }
}
