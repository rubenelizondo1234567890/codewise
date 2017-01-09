<?php

namespace RAPP\Bundle\LoyaltyBundle\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Loyalty Reward Response
 *
 */
class LoyaltyRewardResponse
{

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("errorCode")
     */
    public $errorCode;

    /**
     * @var Reward
     * @JMS\Type("RAPP\Bundle\LoyaltyBundle\Model\LoyaltyReward")
     * @JMS\SerializedName("reward")
     */
    public $reward;

}
