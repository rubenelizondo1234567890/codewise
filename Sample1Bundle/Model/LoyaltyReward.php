<?php

namespace codewise\Bundle\LoyaltyBundle\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Loyalty Reward
 *
 */
class LoyaltyReward
{
    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("id")
     */
    protected $id;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("programId")
     */
    protected $programId;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("name")
     */
    protected $name;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("slug")
     */
    protected $slug;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("description")
     */
    protected $description;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("monetaryValue")
     */
    protected $monetaryValue;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("picture")
     */
    protected $picture;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("pictureSmall")
     */
    protected $pictureSmall;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("sku")
     */
    protected $sku;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("offerID")
     */
    protected $offerID;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("promoID")
     */
    protected $promoID;

    /**
     * @var boolean
     * @JMS\Type("boolean")
     * @JMS\SerializedName("active")
     */
    protected $active;

    /**
     * @var boolean
     * @JMS\Type("boolean")
     * @JMS\SerializedName("isClaimable")
     */
    protected $isClaimable;

    /**
     * @var \DateTime
     * @JMS\Type ("DateTime<'Y-m-d H:i:s'>")
     * @JMS\SerializedName("startDate")
     */
    protected $startDate;

    /**
     * @var \DateTime
     * @JMS\Type("DateTime<'Y-m-d H:i:s'>")
     * @JMS\SerializedName("endDate")
     */
    protected $endDate;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("rewardDescription")
     */
    protected $rewardDescription;

    public function __construct()
    {
        $this->startDate = new \DateTime();
        $this->endDate = new \DateTime();

        $this->startDate = $this->startDate->modify('+2 day');
        $this->endDate = $this->endDate->modify('+3 day');

        $this->active = false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getProgramId()
    {
        return $this->programId;
    }

    public function setProgramId($programId)
    {
        $this->programId = $programId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getMonetaryValue()
    {
        return $this->monetaryValue;
    }

    public function setMonetaryValue($monetaryValue)
    {
        $this->monetaryValue = $monetaryValue;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function getPictureSmall()
    {
        return $this->pictureSmall;
    }

    public function setPictureSmall($pictureSmall)
    {
        $this->pictureSmall = $pictureSmall;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getOfferID()
    {
        return $this->offerID;
    }

    public function setOfferID($offerID)
    {
        $this->offerID = $offerID;
    }

    public function getPromoID()
    {
        return $this->promoID;
    }

    public function setPromoID($promoID)
    {
        $this->promoID = $promoID;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getIsClaimable()
    {
        return $this->isClaimable;
    }

    public function setIsClaimable($isClaimable)
    {
        $this->isClaimable = $isClaimable;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    public function getRewardDescription()
    {
        return $this->rewardDescription;
    }

    public function setRewardDescription($rewardDescription)
    {
        $this->rewardDescription = $rewardDescription;
    }

}
