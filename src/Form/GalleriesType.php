<?php

namespace App\Form;

use App\Entity\Galleries;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class GalleriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filename', FileType::class, array('label' => 'filename (jpeg file)'))
            //->add('uniquefilename')
            //->add('image')
            //->add('duration')
            //->add('creationDate')
            //->add('idType')automated
            //->add('idPortfolio')automated
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Galleries::class,
        ]);
    }
}
