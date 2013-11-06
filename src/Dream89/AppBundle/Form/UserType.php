<?php

namespace Dream89\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', null, array(
                'label' => false,
            ))
            ->add('last_name', null, array(
                'label' => false,
            ))
            ->add('email', null, array(
                'label' => false,
            ))
            ->add('username', null, array(
                'label' => false,
            ))
            ->add('password', null, array(
                'label' => false,
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dream89\AppBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'user';
    }

}