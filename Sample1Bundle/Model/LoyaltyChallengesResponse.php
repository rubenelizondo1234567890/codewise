<?php

namespace codewise\Bundle\LoyaltyBundle\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Loyalty Challenges Response
 *
 */
class LoyaltyChallengesResponse
{

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("errorCode")
     */
    public $errorCode;

    /**
     * @var challenges
     * @JMS\Type("ArrayCollection<codewise\Bundle\LoyaltyBundle\Model\LoyaltyChallenge>")
     * @JMS\SerializedName("challenges")
     */
    public $challenges;

}
