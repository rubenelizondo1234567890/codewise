<?php

namespace RAPP\Bundle\LoyaltyBundle\Model;


use RAPP\Bundle\LoyaltyBundle\Model\LoyaltyOfferBundleItems;
use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * OfferBundle
 *
 */
class LoyaltyOfferBundle
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
     * @JMS\SerializedName("name")
     */
    protected $name;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("desc")
     */
    protected $desc;

    /**
     * @var boolean
     * @JMS\Type("boolean")
     * @JMS\SerializedName("active")
     */
    protected $active;

    /**
     * @var \DateTime
     * @JMS\Type ("DateTime<'Y-m-d H:i:s'>")
     * @JMS\SerializedName("startDate")
     */
    protected $startDate;

    /**
     * @var \DateTime
     * @JMS\Type ("DateTime<'Y-m-d H:i:s'>")
     * @JMS\SerializedName("endDate")
     */
    protected $endDate;

   /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("typeId")
     */
    protected $typeId;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("typeName")
     */
    protected $typeName;

    /**
     * @var offerBundleItems
     * @JMS\Type("ArrayCollection<RAPP\Bundle\LoyaltyBundle\Model\LoyaltyOfferBundleItems>")
     * @JMS\SerializedName("offerBundleItems")
     */
    public $offerBundleItems;

    public function __construct()
    {
        $this->startDate = new \DateTime();
        $this->endDate = new \DateTime();

        $this->startDate = $this->startDate->modify('+2 day');
        $this->endDate = $this->endDate->modify('+3 day');

        $this->offerBundleItems = new ArrayCollection();
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
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

    public function getTypeId(){
        return $this->typeId;
    }

    public function setTypeId($typeId){
        $this->typeId = $typeId;
    }

    public function getTypeName(){
        return $this->typeName;
    }

    public function setTypeName($typeName){
        $this->typeName = $typeName;
    }

    public function getOfferBundleItems(){
        return $this->offerBundleItems;
    }

    public function setOfferBundleItems(ArrayCollection $offerBundleItems){
        $this->offerBundleItems = $offerBundleItems;
    }
}
