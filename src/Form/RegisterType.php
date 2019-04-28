<?php

namespace App\Form;

use App\Entity\Portfolios;

use App\Form\UserType;
use App\Form\CvType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            //->add('idApp')
            ->add('idCv')
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
            //->add('idGallery')
            ->add('idProject')
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
