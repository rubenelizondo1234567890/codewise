<?php

namespace RetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RetsSearchFormModelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('state')
            ->add('propertyType')
            ->add('propertyClass')
            ->add('listPriceMin')
            ->add('listPriceMax')
            ->add('status')
            ->add('yearBuildMin')
            ->add('yearBuildMax')
            ->add('listingContractDateMin')
            ->add('listingContractDateMax')
            ->add('postalCode')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RetsBundle\Model\RetsSearchFormModel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'retsbundle_retssearchformmodel';
    }


}
