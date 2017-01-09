<?php

namespace codewise\Bundle\LoyaltyBundle\Model;

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
     * @JMS\Type("codewise\Bundle\LoyaltyBundle\Model\LoyaltyReward")
     * @JMS\SerializedName("reward")
     */
    public $reward;

}
