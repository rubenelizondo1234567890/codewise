<?php

namespace codewise\Bundle\LoyaltyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class LoyaltyChallengeRequirementsType extends AbstractType
{
    private $checkCategory;

    public function __construct($checkCategory)
    {
        $this->checkCategory = $checkCategory;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $ckc = $this->checkCategory;
        $id = $description = [];
        foreach ($ckc as $value) {
            array_push($id, intval($value->id));
            array_push($description, $value->description);
        }

        for ($i=0; $i < count($ckc); $i++) { 
            $description[$i] = $id[$i].' - '.$description[$i];
        }

        $builder            
            ->add('id', 'hidden', array(
                'required' => false
                ))
            ->add('quantity', 'choice', array(
                'label' => 'Category:',
                'required' => false,
                'placeholder' => 'Select a Category...',
                'choice_list' => new ChoiceList($id, $description)
                ))
            ->add('count', 'integer', array(
                'label' => 'Count:',
                'required' => false
                ))
            ->add('minPoints', 'integer', array(
                'label' => 'Min. Points:',
                'required' => false
                ))
            ->add('amount', 'number', array(
                'label' => 'Amount:',
                'required' => false
                ))
            ->add('shift', 'choice', array(
                'label' => 'Shift:',
                'required' => false,
                'placeholder' => 'Select...',
                'choice_list' => new ChoiceList(array('L', 'D'), array('Lunch', 'Dinner'))
                ))
            ->add('survey', 'choice', array(
                'label' => 'Survey:',
                'required' => false,
                'placeholder' => 'Select...',
                'choice_list' => new ChoiceList(array(0, 1), array('No', 'Yes'))
                ))
            ->add('takeout', 'choice', array(
                'label' => 'Takeout:',
                'required' => false,
                'placeholder' => 'Select...',
                'choice_list' => new ChoiceList(array(0, 1), array('No', 'Yes'))
                ))
            ->add('weekdayMin', 'choice', array(
                'label' => 'Weekday Min.:',
                'required' => false,
                'placeholder' => 'Select...',
                'choice_list' => new ChoiceList(
                                                array(1, 2, 3, 4, 5),
                                                array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')
                                                )
                ))
            ->add('weekdayMax', 'choice', array(
                'label' => 'Weekday Max.:',
                'required' => false,
                'placeholder' => 'Select...',
                'choice_list' => new ChoiceList(
                                                array(1, 2, 3, 4, 5),
                                                array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')
                                                )
                ))
            ->add('numVisits', 'integer', array(
                'label' => 'Num. Visits:',
                'required' => false
                ))
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'codewise\Bundle\LoyaltyBundle\Model\LoyaltyChallengeRequirements'
        ));
    }

    public function getName()
    {
        return 'LoyaltyChallengeRequirements';
    }
}
