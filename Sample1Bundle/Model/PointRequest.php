<?php

namespace RAPP\Bundle\LoyaltyBundle\Model;

class PointRequest
{

    /**
     * @var integer
     */
    private $brinkerMemberId;

    /**
     * @var \DateTime
     */
    private $businessDate;

    /**
     * @var integer
     */
    private $checkNumber;

    /**
     * @var decimal
     */
    private $checkTotal;

    /**
     * @var integer
     */
    private $storeNumber;

    public function jsonSerialize()
    {
        return array(
            'loyaltyID' => $this->brinkerMemberId,
            'businessDate' => $this->businessDate->format('Y-m-d'),
            'checkNumber' => $this->checkNumber,
            'checkTotal' => number_format(preg_replace('/[^0-9.]+/', '', $this->checkTotal), 2),
            'storeNumber' => $this->storeNumber,
        );
    }

    public function getBrinkerMemberId()
    {
        return $this->brinkerMemberId;
    }

    public function setBrinkerMemberId($brinkerMemberId)
    {
        $this->brinkerMemberId = $brinkerMemberId;
    }

    public function getBusinessDate()
    {
        return $this->businessDate;
    }

    public function setBusinessDate(\DateTime $businessDate)
    {
        $this->businessDate = $businessDate;
    }

    public function getCheckNumber()
    {
        return $this->checkNumber;
    }

    public function setCheckNumber($checkNumber)
    {
        $this->checkNumber = $checkNumber;
    }

    public function getCheckTotal()
    {
        return $this->checkTotal;
    }

    public function setCheckTotal($checkTotal)
    {
        $this->checkTotal = $checkTotal;
    }

    public function getStoreNumber()
    {
        return $this->storeNumber;
    }

    public function setStoreNumber($storeNumber)
    {
        $this->storeNumber = $storeNumber;
    }

}
