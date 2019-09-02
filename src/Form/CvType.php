<?php

namespace App\Form;

use App\Entity\Cv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('name')
            ->add('lastname')
            ->add('street')
            ->add('streetNumber')
            ->add('locality')
            ->add('postalCode')
            ->add('mail')
            ->add('phoneNumber')
            ->add('anniversary')
            ->add('creationDate')
            ->add('presentation')
            //->add('publishedAt') automated
            ->add('active')
            //->add('idOrder')
            ->add('idWorkingLicense')
            ->add('idDepartment')
            ->add('idTypeCv')
            //->add('idCountry')
            //->add('idDriverSLicense')
            //->add('idExperience')
            //->add('idHobbie')
            //->add('idSkill')
            //->add('idTraining')
            //->add('idPortfolio')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cv::class,
        ]);
    }
}
