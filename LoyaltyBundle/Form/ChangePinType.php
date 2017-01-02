<?php

namespace RAPP\Bundle\LoyaltyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangePinType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('brinkerMemberId', 'hidden', array(
                    'required' => true
                    ))
                ->add('newPin', 'text', array(
                    'required' => true, 
                    'attr' => array(
                        'placeholder' => '4 digits'
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
            'data_class' => 'RAPP\Bundle\LoyaltyBundle\Model\ChangePin',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'loyalty_change_pin';
    }

}
