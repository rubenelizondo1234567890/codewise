<?php

namespace RAPP\Bundle\LoyaltyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConsumerType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('brinkerMemberId')
                ->add('enrollDate')
                ->add('totalPoints')
                ->add('firstName')
                ->add('phone')
                ->add('storeCode')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RAPP\Bundle\LoyaltyBundle\Model\Consumer',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'loyalty_consumer';
    }

}
