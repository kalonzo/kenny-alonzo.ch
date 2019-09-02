<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Translation\TranslatorInterface;

class CivilStatus extends AbstractType
{
    private $translator;
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                $this->translator->trans('Single')  => 1,
                $this->translator->trans('Married') => 2,
                $this->translator->trans('Not sure') => 3,
            ),
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}