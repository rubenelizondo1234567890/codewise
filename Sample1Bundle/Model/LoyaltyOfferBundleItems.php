<?php

namespace RAPP\Bundle\LoyaltyBundle\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * OfferBundle
 *
 */
class LoyaltyOfferBundleItems
{

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("id")
     */
    protected $id;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("bundleItem")
     */
    protected $bundleItem;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("order")
     */
    protected $order;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("weight")
     */
    protected $weight;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("offerId")
     */
    protected $offerId;

    public function __construct()
    {

    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getBundleItem()
    {
        return $this->bundleItem;
    }

    public function setBundleItem($bundleItem)
    {
        $this->bundleItem = $bundleItem;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getOfferId()
    {
        return $this->offerId;
    }

    public function setOfferId($offerId)
    {
        $this->offerId = $offerId;
    }

}
