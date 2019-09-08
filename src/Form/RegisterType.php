<?php

namespace App\Form;

use App\Entity\Portfolios;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('idApp')
            ->add('name')
            //->add('slug')automated
            ->add('descn')
            //->add('creationDate')
            //->add('publishedAt')
            //->add('active')automated
            //->add('idHeader')
           // ->add('idNavbar')
           // ->add('idMenuContent')
            //->add('idWidget')
            //->add('idContent')
            //->add('idFooter')
            //->add('idGallery')
            //->add('idProject')
            //->add('idWeb')
        ;
        //Embed  Form
        $builder->add('user', UserType::class);
        $builder->add('cvs', CvType::class);
        $builder->add('gallery', GalleriesType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Portfolios::class,
        ]);
    }
}
