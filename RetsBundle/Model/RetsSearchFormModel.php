<?php

namespace RetsBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * RetsSearchFormModel
 *
 * @ORM\Table(name="rets_search_form_model")
 */
class RetsSearchFormModel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="propertyType", type="string", length=255)
     */
    private $propertyType;

    /**
     * @var string
     *
     * @ORM\Column(name="propertyClass", type="string", length=255)
     */
    private $propertyClass;

    /**
     * @var int
     *
     * @ORM\Column(name="listPriceMin", type="integer")
     */
    private $listPriceMin;

    /**
     * @var int
     *
     * @ORM\Column(name="listPriceMax", type="integer")
     */
    private $listPriceMax;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="yearBuildMin", type="integer", nullable=true)
     */
    private $yearBuildMin;

    /**
     * @var int
     *
     * @ORM\Column(name="yearBuildMax", type="integer", nullable=true)
     */
    private $yearBuildMax;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="listingContractDateMin", type="datetime")
     */
    private $listingContractDateMin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="listingContractDateMax", type="datetime")
     */
    private $listingContractDateMax;

    /**
     * @var int
     *
     * @ORM\Column(name="PostalCode", type="integer", nullable=true)
     */
    private $postalCode;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return RetsSearchFormModel
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set propertyType
     *
     * @param string $propertyType
     *
     * @return RetsSearchFormModel
     */
    public function setPropertyType($propertyType)
    {
        $this->propertyType = $propertyType;

        return $this;
    }

    /**
     * Get propertyType
     *
     * @return string
     */
    public function getPropertyType()
    {
        return $this->propertyType;
    }

    /**
     * Set propertyClass
     *
     * @param string $propertyClass
     *
     * @return RetsSearchFormModel
     */
    public function setPropertyClass($propertyClass)
    {
        $this->propertyClass = $propertyClass;

        return $this;
    }

    /**
     * Get propertyClass
     *
     * @return string
     */
    public function getPropertyClass()
    {
        return $this->propertyClass;
    }

    /**
     * Set listPriceMin
     *
     * @param integer $listPriceMin
     *
     * @return RetsSearchFormModel
     */
    public function setListPriceMin($listPriceMin)
    {
        $this->listPriceMin = $listPriceMin;

        return $this;
    }

    /**
     * Get listPriceMin
     *
     * @return int
     */
    public function getListPriceMin()
    {
        return $this->listPriceMin;
    }

    /**
     * Set listPriceMax
     *
     * @param integer $listPriceMax
     *
     * @return RetsSearchFormModel
     */
    public function setListPriceMax($listPriceMax)
    {
        $this->listPriceMax = $listPriceMax;

        return $this;
    }

    /**
     * Get listPriceMax
     *
     * @return int
     */
    public function getListPriceMax()
    {
        return $this->listPriceMax;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return RetsSearchFormModel
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set yearBuildMin
     *
     * @param integer $yearBuildMin
     *
     * @return RetsSearchFormModel
     */
    public function setYearBuildMin($yearBuildMin)
    {
        $this->yearBuildMin = $yearBuildMin;

        return $this;
    }

    /**
     * Get yearBuildMin
     *
     * @return int
     */
    public function getYearBuildMin()
    {
        return $this->yearBuildMin;
    }

    /**
     * Set yearBuildMax
     *
     * @param integer $yearBuildMax
     *
     * @return RetsSearchFormModel
     */
    public function setYearBuildMax($yearBuildMax)
    {
        $this->yearBuildMax = $yearBuildMax;

        return $this;
    }

    /**
     * Get yearBuildMax
     *
     * @return int
     */
    public function getYearBuildMax()
    {
        return $this->yearBuildMax;
    }

    /**
     * Set listingContractDateMin
     *
     * @param \DateTime $listingContractDateMin
     *
     * @return RetsSearchFormModel
     */
    public function setListingContractDateMin($listingContractDateMin)
    {
        $this->listingContractDateMin = $listingContractDateMin;

        return $this;
    }

    /**
     * Get listingContractDateMin
     *
     * @return \DateTime
     */
    public function getListingContractDateMin()
    {
        return $this->listingContractDateMin;
    }

    /**
     * Set listingContractDateMax
     *
     * @param \DateTime $listingContractDateMax
     *
     * @return RetsSearchFormModel
     */
    public function setListingContractDateMax($listingContractDateMax)
    {
        $this->listingContractDateMax = $listingContractDateMax;

        return $this;
    }

    /**
     * Get listingContractDateMax
     *
     * @return \DateTime
     */
    public function getListingContractDateMax()
    {
        return $this->listingContractDateMax;
    }

    /**
     * Set postalCode
     *
     * @param integer $postalCode
     *
     * @return RetsSearchFormModel
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return int
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }
}

