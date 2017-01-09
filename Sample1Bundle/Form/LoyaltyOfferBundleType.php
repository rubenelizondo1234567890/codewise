<?php

namespace codewise\Bundle\LoyaltyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class LoyaltyOfferBundleType extends AbstractType
{
    private $bundleTypes;

    public function __construct($bundleTypes)
    {
        $this->bundleTypes = $bundleTypes;
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $bt = $this->bundleTypes;
        $id = $description = [];
        
        foreach ($bt as $value) {
            array_push($id, intval($value->id));
            switch ($value->name) {
                case 'RewardChoice':
                    $desc = 'Reward Choice';
                    break;
                case 'ChallengeChoice':
                    $desc = 'Challenge Choice';
                    break;
                case 'RewardMysteryBox':
                    $desc = 'Reward Mystery Box';
                    break;
                default:
                    $desc = $value->name;
                    break;
            }
            array_push($description, $desc);
        }

        $builder
            ->add('name', null, array(
                'label' => 'Name: *',
                'required' => true,
                'attr'   =>  array(
                    'maxLength'   => 255
                    )
                ))
            ->add('desc', null, array(
                'label' => 'Offer Bundle Desc (unique): *',
                'required' => true,
                'attr'   =>  array(
                    'maxLength'   => 20
                    )
                ))
            ->add('startDate', 'date', array(
                'label' => 'Start Date: *',
                'widget' => 'single_text',
                'required' => true
                ))
            ->add('endDate', 'date', array(
                'label' => 'End Date: *',
                'widget' => 'single_text',
                'required' => true
                ))
            ->add('typeId', 'choice', array(
                'label' => 'Bundle Type:',
                'required' => false,
                'placeholder' => 'Select a Type...',
                'choice_list' => new ChoiceList($id, $description)
                ))
            ->add('offerBundleItems', 'collection', array(
                    'type' => new LoyaltyOfferBundleItemsType(),
                    'allow_add'    => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'label' => 'Item:',
                    'attr'   =>  array(
                        'class'   => 'rubs-selector',
                    )
                ))
        ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'codewise\Bundle\LoyaltyBundle\Model\LoyaltyOfferBundle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'LoyaltyOfferBundle';
    }
}
