<?php

namespace codewise\Bundle\LoyaltyBundle\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Loyalty Offer Bundle Response
 *
 */
class LoyaltyOfferBundleResponse
{

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("errorCode")
     */
    public $errorCode;

    /**
     * @var offerBundle
     * @JMS\Type("codewise\Bundle\LoyaltyBundle\Model\LoyaltyOfferBundle")
     * @JMS\SerializedName("offerBundle")
     */
    public $offerBundle;

}
