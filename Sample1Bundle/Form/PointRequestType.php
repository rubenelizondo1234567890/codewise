<?php

namespace codewise\Bundle\LoyaltyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PointRequestType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new DateTimeToStringTransformer(null, null, 'Y-m-d');

        $builder
                ->add('codewiseMemberId', null, array('required' => true))
                ->add($builder->create('businessDate', 'date', array(
                            'attr' => array(
                                'style' => 'width: auto',
                                'class' => 'datepicker',
                            ),
                            'label' => 'Business Date',
                            'input' => 'string',
                            'format' => 'MM/dd/yyyy',
                            'widget' => 'single_text',
                        ))->addModelTransformer($transformer))
                ->add('checkNumber', null, array('required' => true))
                ->add('checkTotal', 'money', array('currency' => 'USD'))
                ->add('storeNumber', null, array('required' => true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'codewise\Bundle\LoyaltyBundle\Model\PointRequest',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'loyalty_point_request';
    }

}
