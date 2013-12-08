<?php

namespace Shareit\MainBundle\Form;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Shareit\MainBundle\Form\Constraints\UniqueUsername;
use Shareit\MainBundle\Form\Constraints\UniqueUserEmail;
use Shareit\MainBundle\Form\ProfileType;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array(
                'required' => false,
                'constraints' => array(
//                    new UniqueUsername(),
                )))
            ->add('email', null, array(
                'required' => false,
                'constraints' => array(
//                    new UniqueUserEmail(),
                )))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'required' => false,
                'constraints' => array(
                    new Length(array(
                        'min' => 6
                    )),
                )
            ))
            ->add('profile', new ProfileType());
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Shareit\MainBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'user';
    }

}

