<?php

namespace codewise\Bundle\LoyaltyBundle\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Loyalty Challenge Response
 *
 */
class LoyaltyChallengeResponse
{

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("errorCode")
     */
    public $errorCode;

    /**
     * @var challenge
     * @JMS\Type("codewise\Bundle\LoyaltyBundle\Model\LoyaltyChallenge")
     * @JMS\SerializedName("challenge")
     */
    public $challenge;

}
