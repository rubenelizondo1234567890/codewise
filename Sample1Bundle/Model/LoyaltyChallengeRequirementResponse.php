<?php

namespace codewise\Bundle\LoyaltyBundle\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Loyalty Challenge Requirement Response
 *
 */
class LoyaltyChallengeRequirementResponse
{

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("errorCode")
     */
    public $errorCode;

    /**
     * @var checkCategory
     * @JMS\Type("codewise\Bundle\LoyaltyBundle\Model\LoyaltyChallengeRequirement")
     * @JMS\SerializedName("checkCategory")
     */
    public $checkCategory;

}
