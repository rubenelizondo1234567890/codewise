<?php

namespace RAPP\Bundle\LoyaltyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangePasswordType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('brinkerMemberId', 'hidden', array(
                    'required' => true
                    ))
                ->add('newPassword', 'text', array(
                    'required' => true, 
                    'attr' => array(
                        'placeholder' => '6-15 characters with at least 1 number'
                        )
                    ))
                ->add('notes', 'textarea', array(
                    'required' => false
                    ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RAPP\Bundle\LoyaltyBundle\Model\ChangePassword',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'loyalty_change_password';
    }

}
