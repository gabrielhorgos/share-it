<?php

namespace Shareit\MainBundle\Form;

use Shareit\MainBundle\Form\Constraints\Gender;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GenderType extends AbstractType
{

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'Mr' => 'Mr',
                'Mrs' => 'Mrs',
                'Ms' => 'Ms',
            ),
            'expanded' => true,
            'multiple' => false,
            'constraints' => array(
                new Gender(),
            )
        ));
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'gender';
    }

}

