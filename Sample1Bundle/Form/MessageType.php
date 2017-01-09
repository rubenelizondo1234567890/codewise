<?php

namespace RAPP\Bundle\LoyaltyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MessageType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('type', 'choice', array(
                    'choices' => array(
                        //'R1SiteWelcome' => '[R1s] (Site) Welcome Email',
                        //'R1ZioskWelcome' => '[R1z] (Ziosk) Welcome Email',
                        //'R2AlmostThere' => '[R2] Almost There (Triple Dipper) Email',
                        //'R4Visit' => '[R4] Visit Email',
                        'C1ForgotPassword' => '[C1] Forgot Password Email',
                        'C5ForgotPinEmail' => '[C5e] Forgot PIN Email',
                        'C5ForgotPinSMS' => '[C5s] Forgot PIN SMS',
                        //'R3TripleDipper' => '[R3] Triple Dipper Email',
                        //'R6PlatinumStatus' => '[R6] Platinum Status Email',
                        'R8Birthday' => '[R8] Birthday Email',
                    ),
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RAPP\Bundle\LoyaltyBundle\Model\Message',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'loyalty_message';
    }

}
