<?php

namespace RAPP\Bundle\LoyaltyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class LoyaltyOfferBundleItemsType extends AbstractType
{    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Hack to override Symfony validation error when submiting the form
        // as this field is modified dynamically from within the form
        for ($i=0; $i < 1000; $i++) { 
            $och[] = $i;
        }

        $builder
            ->add('bundleItem', 'choice', array(
                'label' => 'Item Type: *',
                'required' => true,
                'placeholder' => 'Select Offer Type...',
                'choice_list' => new ChoiceList(
                                        array('ChallengeChoice', 'RewardChoice', 'RewardMysteryBox'), 
                                        array('Challenge', 'Reward', 'Offer Bundle')
                                        )
                ))
            ->add('offerId', 'choice', array(
                'label' => 'Child Id: *',
                'required' => false,
                'placeholder' => 'Select Offer Type...',
                'choice_list' => new ChoiceList($och, $och)
                ))
            ->add('order',  'hidden', array(
                'label' => 'Order: *',
                'required' => true,
                ))
            ->add('Weight', 'number', array(
                'label' => 'weight: *',
                'required' => true,
                'attr' => array('title' => 'The weight field is used to calculate the percent chance a reward will be chosen for the given Reward Mystery Box. If you specify "30" there will be a 30% chance that item is selected. The total weight for a Reward Mystery Box must add up to 100%'),
                ))
        ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RAPP\Bundle\LoyaltyBundle\Model\LoyaltyOfferBundleItems'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'LoyaltyOfferBundleItems';
    }
}
