<?php

namespace codewise\Bundle\LoyaltyBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class PointAdjustment
{

    /**
     * @var integer
     */
    private $codewiseMemberId;

    /**
     * @var integer
     *
     * @Assert\Range(min = -300, max = 300, minMessage = "Minimum {{ limit }}", maxMessage = "Maximum {{ limit }}")
     */
    private $points;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    private $notes;

    /**
     * @var string
     */
    private $user;

    public function jsonSerialize()
    {
        return array(
            'loyaltyID' => $this->codewiseMemberId,
            'points' => $this->points,
            'notes' => $this->notes,
            'user' => $this->user,
        );
    }

    public function getcodewiseMemberId()
    {
        return $this->codewiseMemberId;
    }

    public function setcodewiseMemberId($codewiseMemberId)
    {
        $this->codewiseMemberId = $codewiseMemberId;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function setPoints($points)
    {
        $this->points = $points;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

}
