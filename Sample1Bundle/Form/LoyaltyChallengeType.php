<?php

namespace codewise\Bundle\LoyaltyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class LoyaltyChallengeType extends AbstractType
{
    private $checkCategory;

    private $rewards;

    private $challengeCategories;

    public function __construct($checkCategory, $rewards, $challengeCategories)
    {
        $this->checkCategory = $checkCategory;

        $this->rewards = $rewards;

        $this->challengeCategories = $challengeCategories;
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
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

        $chc = $this->challengeCategories;
        $id_chc = $description_chc = [];

        foreach ($chc as $value) {
            array_push($id_chc, intval($value->id));
            array_push($description_chc, $value->name);
        }

        for ($i=0; $i < count($chc); $i++) { 
            $description_chc[$i] = $id_chc[$i].' - '.$description_chc[$i];
        }

        $builder
            ->add('categoryId', 'choice', array(
                'label' => 'Challenge Category:',
                'required' => true,
                'placeholder' => 'Select a Category...',
                'choice_list' => new ChoiceList($id_chc, $description_chc)
                ))      
            ->add('campaignId', 'integer', array(
                'label' => 'Campaign Id: *',
                'required' => true
                ))
            ->add('name', null, array(
                'label' => 'Name: *',
                'required' => true,
                'attr'   =>  array(
                    'maxLength'   => 255
                    )
                ))
            ->add('sku', null, array(
                'label' => 'Sku: *',
                'required' => true,
                'attr'   =>  array(
                    'maxLength'   => 20
                    )
                ))
            ->add('summary', null, array(
                'label' => 'Summary:',
                'required' => false
                ))
            ->add('webDescription', 'textarea', array(
                'label' => 'Web Description:',
                'required' => false,
                'attr'   =>  array(
                    'rows'   => 3,
                    'maxLength'   => 4000
                    )
                ))
            ->add('webDisclaimer', null, array(
                'label' => 'Web Disclaimer:',
                'required' => false,
                'attr'   =>  array(
                    'maxLength'   => 255
                    )
                ))
            ->add('webImage', null, array(
                'label' => 'Web Image:',
                'required' => false,
                'attr'   =>  array(
                    'maxLength'   => 255
                    )
                ))
            ->add('emailDescription', 'textarea', array(
                'label' => 'Email Description:',
                'required' => false,
                'attr'   =>  array(
                    'rows'   => 3,
                    'maxLength'   => 4000
                    )
                ))
            ->add('emailDisclaimer', null, array(
                'label' => 'Email Disclaimer:',
                'required' => false,
                'attr'   =>  array(
                    'maxLength'   => 255
                    )
                ))
            ->add('emailImage', null, array(
                'label' => 'Email Image:',
                'required' => false,
                'attr'   =>  array(
                    'maxLength'   => 255
                    )
                ))
            ->add('zioskDescription', 'textarea', array(
                'label' => 'Ziosk Description:',
                'required' => false,
                'attr'   =>  array(
                    'rows'   => 3,
                    'maxLength'   => 4000
                    )
                ))
            ->add('zioskDisclaimer', null, array(
                'label' => 'Ziosk Disclaimer:',
                'required' => false,
                'attr'   =>  array(
                    'maxLength'   => 255
                    )
                ))
            ->add('zioskImage', null, array(
                'label' => 'Ziosk Image:',
                'required' => false,
                'attr'   =>  array(
                    'maxLength'   => 255
                    )
                ))
            ->add('sequence', 'integer', array(
                'label' => 'Sequence: *',
                'required' => true
                ))
            ->add('minPoints', 'integer', array(
                'label' => 'Min. Points:',
                'required' => false
                ))
            ->add('maxPoints', 'integer', array(
                'label' => 'Max. Points:',
                'required' => false
                ))
            ->add('earnLimit', 'integer', array(
                'label' => 'Earn Limit:',
                'required' => false
                ))
            ->add('offerLimit', 'integer', array(
                'label' => 'Offer Limit:',
                'required' => false
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
            ->add('startDelay', 'integer', array(
                'label' => 'Start Delay: *',
                'required' => true
                ))
            ->add('duration', 'integer', array(
                'label' => 'Duration *:',
                'required' => true
                ))
            ->add('slug', null, array(
                'label' => 'Slug: *',
                'required' => true,
                'attr'   =>  array(
                    'maxLength'   => 30
                    )
                ))
            ->add('active', 'choice', array(
                'label' => 'Active: *',
                'required' => true,
                'choice_list' => new ChoiceList(array(0, 1), array('No', 'Yes'))
                ))
            ->add('staleHoldout', 'integer', array(
                'label' => 'Stale Holdout:',
                'required' => false
                ))
            ->add('exclude', 'choice', array(
                'label' => 'Exclude: *',
                'required' => true,
                'choice_list' => new ChoiceList(array(0, 1), array('No', 'Yes'))
                ))
            ->add('rewardId', 'choice', array(
                'label' => 'Reward:',
                'required' => false,
                'placeholder' => 'Select a Reward...',
                'choice_list' => new ChoiceList($id, $description)
                ))
            ->add('rewardValidDuration', 'integer', array(
                'label' => 'Reward Duration:',
                'required' => false
                ))
            ->add('multiplier', 'number', array(
                'label' => 'Multiplier:',
                'required' => false,
                'precision' => 18
                ))
            ->add('challengeRequirements0', 'choice', array(
                'label' => 'Requirements: *',
                'required' => true,
                'placeholder' => 'Select a Requirement...',
                'choice_list' => new ChoiceList(
                                    array(
                                        'checkCategory',
                                        'checkReward',
                                        'checkSpend',
                                        'checkShift',
                                        'checkSurvey',
                                        'checkTakeout',
                                        'checkWeekday',
                                        'consumerFrequency',
                                        ),
                                    array(
                                        'Check Category',
                                        'Check Reward',
                                        'Check Spend',
                                        'Check Shift',
                                        'Check Survey',
                                        'Check Takeout',
                                        'Check Weekday',
                                        'Consumer Frequency',
                                        )
                                    )
                ))
            ->add('LoyaltyChallengeRequirements0', new LoyaltyChallengeRequirementsType($this->checkCategory), array(
                'label' => 'Requirement Options: *',
                ))
            ->add('challengeRequirements1', 'choice', array(
                'label' => 'Requirements: *',
                'required' => false,
                'placeholder' => 'Select a Requirement...',
                'choice_list' => new ChoiceList(
                                    array(
                                        'checkCategory',
                                        'checkReward',
                                        'checkSpend',
                                        'checkShift',
                                        'checkSurvey',
                                        'checkTakeout',
                                        'checkWeekday',
                                        'consumerFrequency',
                                        ),
                                    array(
                                        'Check Category',
                                        'Check Reward',
                                        'Check Spend',
                                        'Check Shift',
                                        'Check Survey',
                                        'Check Takeout',
                                        'Check Weekday',
                                        'Consumer Frequency',
                                        )
                                    )
                ))
            ->add('LoyaltyChallengeRequirements1', new LoyaltyChallengeRequirementsType($this->checkCategory), array(
                'label' => 'Requirement Options: *',
                ))
            ->add('challengeRequirements2', 'choice', array(
                'label' => 'Requirements: *',
                'required' => false,
                'placeholder' => 'Select a Requirement...',
                'choice_list' => new ChoiceList(
                                    array(
                                        'checkCategory',
                                        'checkReward',
                                        'checkSpend',
                                        'checkShift',
                                        'checkSurvey',
                                        'checkTakeout',
                                        'checkWeekday',
                                        'consumerFrequency',
                                        ),
                                    array(
                                        'Check Category',
                                        'Check Reward',
                                        'Check Spend',
                                        'Check Shift',
                                        'Check Survey',
                                        'Check Takeout',
                                        'Check Weekday',
                                        'Consumer Frequency',
                                        )
                                    )
                ))
            ->add('LoyaltyChallengeRequirements2', new LoyaltyChallengeRequirementsType($this->checkCategory), array(
                'label' => 'Requirement Options: *',
                ))
        ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'codewise\Bundle\LoyaltyBundle\Model\LoyaltyChallenge'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'LoyaltyChallenge';
    }
}
