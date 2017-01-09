<?php

namespace codewise\Bundle\LoyaltyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class LoyaltyRewardType extends AbstractType
{
    private $rewardPrograms;

    public function __construct($rewardPrograms)
    {
        $this->rewardPrograms = $rewardPrograms;
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $rp = $this->rewardPrograms;
        $id = $description = [];
        
        foreach ($rp as $value) {
            array_push($id, intval($value->id));
            array_push($description, $value->name);
        }

        for ($i=0; $i < count($rp); $i++) { 
            $description[$i] = $id[$i].' - '.$description[$i];
        }

        $builder            
            ->add('programId', 'choice', array(
                'label' => 'Reward Programs:',
                'required' => true,
                'placeholder' => 'Select a Program...',
                'choice_list' => new ChoiceList($id, $description)
                ))
            ->add('name', null, array(
                'label' => 'Name: *',
                'required' => true,
                'attr'   =>  array(
                    'maxLength'   => 255
                    )
                ))
            ->add('slug', null, array(
                'label' => 'Slug: *',
                'required' => true,
                'attr'   =>  array(
                    'maxLength'   => 20
                    )
                ))
            ->add('sku', null, array(
                'label' => 'Sku: *',
                'required' => true,
                'attr'   =>  array(
                    'maxLength'   => 20
                    )
                ))
            ->add('description', null, array(
                'label' => 'Description: ',
                'required' => false,
                'attr'   =>  array(
                    'maxLength'   => 255
                    )
                ))
            ->add('picture', null, array(
                'label' => 'Picture Url: *',
                'required' => true,
                'attr'   =>  array(
                    'maxLength'   => 255
                    )
                ))
            ->add('pictureSmall', null, array(
                'label' => 'Picture Small Url: *',
                'required' => true,
                'attr'   =>  array(
                    'maxLength'   => 255
                    )
                ))
            ->add('offerID', 'integer', array(
                'label' => 'Offer ID: *',
                'required' => true,
                ))
            ->add('promoID', 'integer', array(
                'label' => 'Promo ID: *',
                'required' => true,
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
            ->add('rewardDescription', null, array(
                'label' => 'Reward Description: ',
                'required' => false,
                'attr'   =>  array(
                    'maxLength'   => 255
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
            'data_class' => 'codewise\Bundle\LoyaltyBundle\Model\LoyaltyReward'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'LoyaltyReward';
    }
}
