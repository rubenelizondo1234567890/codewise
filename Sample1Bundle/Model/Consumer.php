<?php

namespace codewise\Bundle\LoyaltyBundle\Model;

class Consumer
{

    /**
     * @var integer
     */
    private $codewiseMemberId;

    /**
     * @var string
     */
    private $status;

    /**
     * @var integer
     */
    private $basePoints;

    /**
     * @var array
     */
    private $ltoPoints;

    /**
     * @var integer
     */
    private $totalPoints;

    /**
     * @var string
     */
    private $enrollDate;

    /**
     * @var string
     */
    private $pointsExpirationDate;

    /**
     * @var string
     */
    private $tripleDipperEarnDate;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var integer
     */
    private $phone;

    /**
     * @var string
     */
    private $storeCode;

    /**
     * @var integer
     */
    private $birthMonth;

    /**
     * @var integer
     */
    private $birthDay;

    /**
     * @var integer
     */
    private $birthYear;


    private $plentiMemberID;
    private $plentiPhoneNumber;
    private $plentiCardNumber;

    /**
     * @var \stdClass
     */
    private $platinumStatus;
    public $visits;
    public $activities;

    private $active;
    
    public function getcodewiseMemberId()
    {
        return $this->codewiseMemberId;
    }

    public function setcodewiseMemberId($codewiseMemberId)
    {
        $this->codewiseMemberId = $codewiseMemberId;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getBasePoints()
    {
        return $this->basePoints;
    }

    public function setBasePoints($basePoints)
    {
        $this->basePoints = $basePoints;
    }

    public function getLtoPoints()
    {
        return $this->ltoPoints;
    }

    public function setLtoPoints($ltoPoints)
    {
        $this->ltoPoints = $ltoPoints;
    }

    public function getTotalPoints()
    {
        return $this->totalPoints;
    }

    public function setTotalPoints($totalPoints)
    {
        $this->totalPoints = $totalPoints;
    }

    public function getEnrollDate()
    {
        return $this->enrollDate;
    }

    public function setEnrollDate($enrollDate)
    {
        $this->enrollDate = $enrollDate;
    }

    public function getPointsExpirationDate()
    {
        return $this->pointsExpirationDate;
    }

    public function setPointsExpirationDate($pointsExpirationDate)
    {
        $this->pointsExpirationDate = $pointsExpirationDate;
    }

    public function getTripleDipperEarnDate()
    {
        return $this->tripleDipperEarnDate;
    }

    public function setTripleDipperEarnDate($tripleDipperEarnDate)
    {
        $this->tripleDipperEarnDate = $tripleDipperEarnDate;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getStoreCode()
    {
        return $this->storeCode;
    }

    public function setStoreCode($storeCode)
    {
        $this->storeCode = $storeCode;
    }

    public function getBirthMonth()
    {
        return $this->birthMonth;
    }

    public function setBirthMonth($birthMonth)
    {
        $this->birthMonth = $birthMonth;
    }

    public function getBirthDay()
    {
        return $this->birthDay;
    }


    public function setBirthYear($birthYear)
    {
        $this->birthYear = $birthYear;
    }
    public function getBirthYear()
    {
        return $this->birthYear;
    }


    public function setPlentiMemberID($plentiMemberID)
    {
        $this->plentiMemberID = $plentiMemberID;
    }
    public function getPlentiMemberID()
    {
        return $this->plentiMemberID;
    }

    public function setPlentiPhoneNumber($plentiPhoneNumber)
    {
        $this->plentiPhoneNumber = $plentiPhoneNumber;
    }
    public function getPlentiPhoneNumber()
    {
        return $this->plentiPhoneNumber;
    }

    public function setPlentiCardNumber($plentiCardNumber)
    {
        $this->plentiCardNumber = $plentiCardNumber;
    }
    public function getPlentiCardNumber()
    {
        return $this->plentiCardNumber;
    }




    public function setBirthDay($birthDay)
    {
        $this->birthDay = $birthDay;
    }

    public function getPlatinumStatus()
    {
        return $this->platinumStatus;
    }

    public function setPlatinumStatus($platinumStatus)
    {
        $this->platinumStatus = $platinumStatus;
    }

}
