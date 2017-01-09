<?php

namespace codewise\Bundle\LoyaltyBundle\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Offer Bundles Response
 *
 */
class OfferBundlesResponse
{

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("errorCode")
     */
    public $errorCode;

    /**
     * @var offerBundles
     * @JMS\Type("ArrayCollection<codewise\Bundle\LoyaltyBundle\Model\LoyaltyOfferBundle>")
     * @JMS\SerializedName("offerBundles")
     */
    public $offerBundles;

}
