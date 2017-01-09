<?php

namespace RAPP\Bundle\LoyaltyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class AddRewardType extends AbstractType
{    
    private $rewards;

    public function __construct($rewards)
    {
        $this->rewards = $rewards;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $rwd = $this->rewards;
        $id = $description = [];
        foreach ($rwd as $value) {
            array_push($id, intval($value->id));
            array_push($description, $value->name);
        }

        for ($i=0; $i < count($rwd); $i++) { 
            $description[$i] = $id[$i].' - '.$description[$i];
        }

        $builder
                ->add('rewardId', 'choice', array(
                'label' => 'Reward:',
                'required' => true,
                'placeholder' => 'Select a Reward...',
                'choice_list' => new ChoiceList($id, $description)
                ))
                ->add('rewardDuration', 'choice', array(
                'label' => 'Reward Duration:',
                'required' => true,
                'placeholder' => 'Duration of Reward...',
                'choice_list' => new ChoiceList(array(4, 14, 30), array('4 Days', '14 Days', '30 Days'))
                ))
                ->add('notes', 'textarea', array('required' => true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RAPP\Bundle\LoyaltyBundle\Model\AddReward',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'loyalty_add_reward';
    }

}
