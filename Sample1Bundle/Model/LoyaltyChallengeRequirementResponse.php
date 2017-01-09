<?php

namespace RAPP\Bundle\LoyaltyBundle\Model;

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
     * @JMS\Type("RAPP\Bundle\LoyaltyBundle\Model\LoyaltyChallengeRequirement")
     * @JMS\SerializedName("checkCategory")
     */
    public $checkCategory;

}
