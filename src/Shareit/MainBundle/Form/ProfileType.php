<?php

namespace Shareit\MainBundle\Form;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Yaml\Parser;
use Shareit\MainBundle\Form\Constraints\Address;
use Shareit\MainBundle\Form\Constraints\Mobile;
use Shareit\MainBundle\Form\Constraints\Zip;
use Shareit\MainBundle\Form\Constraints\Name;
use Shareit\MainBundle\Form\Constraints\City;
use Shareit\MainBundle\Form\GenderType;

class ProfileType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', new GenderType())
            ->add('firstname', null, array(
                'constraints' => array(
                    new NotBlank(),
                    new Name(),
                )
            ))
            ->add('lastname', null, array(
                'constraints' => array(
                    new NotBlank(),
                    new Name(),
                )))
            ->add('address', null, array(
                'required' => false,
                'constraints' => array(
                    new Address(),
                )
            ))
            ->add('zipcode', 'text', array(
                'attr' => array('maxlength' => 5,
                    'minlength' => 5),
                'required' => false,
                'constraints' => array(
                    new Zip(),
                )
            ))
            ->add('city', null, array(
                'required' => false,
                'constraints' => array(
                    new City(),
                )
            ))
            ->add('phone', null, array(
                'required' => false,
                'constraints' => array(
                    new Mobile(),
                )
            ))
            ->add('company', null, array(
                'required' => false,
            ))
            ->add('description', 'text', array(
                'required' => false,
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Shareit\MainBundle\Entity\Profile',
        ));
    }

    public function getName()
    {
        return 'profile';
    }

}

