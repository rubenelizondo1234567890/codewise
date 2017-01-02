<?php

namespace RAPP\Bundle\LoyaltyBundle\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Challenge
 *
 */
class LoyaltyChallengeRequirements
{

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("id")
     */
    protected $id;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("quantity")
     */
    protected $quantity;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("count")
     */
    protected $count;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("minPoints")
     */
    protected $minPoints;

    /**
     * @var double
     * @JMS\Type("double")
     * @JMS\SerializedName("amount")
     */
    protected $amount;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("shift")
     */
    protected $shift;

    /**
     * @var boolean
     * @JMS\Type("boolean")
     * @JMS\SerializedName("survey")
     */
    protected $survey;

    /**
     * @var boolean
     * @JMS\Type("boolean")
     * @JMS\SerializedName("takeout")
     */
    protected $takeout;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("weekdayMin")
     */
    protected $weekdayMin;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("weekdayMax")
     */
    protected $weekdayMax;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("numVisits")
     */
    protected $numVisits;

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

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getMinPoints()
    {
        return $this->minPoints;
    }

    public function setMinPoints($minPoints)
    {
        $this->minPoints = $minPoints;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getShift()
    {
        return $this->shift;
    }

    public function setShift($shift)
    {
        $this->shift = $shift;
    }

    public function getSurvey()
    {
        return $this->survey;
    }

    public function setSurvey($survey)
    {
        $this->survey = $survey;
    }

    public function getTakeout()
    {
        return $this->takeout;
    }

    public function setTakeout($takeout)
    {
        $this->takeout = $takeout;
    }

    public function getWeekdayMin()
    {
        return $this->weekdayMin;
    }

    public function setWeekdayMin($weekdayMin)
    {
        $this->weekdayMin = $weekdayMin;
    }

    public function getWeekdayMax()
    {
        return $this->weekdayMax;
    }

    public function setWeekdayMax($weekdayMax)
    {
        $this->weekdayMax = $weekdayMax;
    }

    public function getNumVisits()
    {
        return $this->numVisits;
    }

    public function setNumVisits($numVisits)
    {
        $this->numVisits = $numVisits;
    }
}
