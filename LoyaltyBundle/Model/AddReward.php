<?php

namespace RAPP\Bundle\LoyaltyBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class AddReward
{

    /**
     * @var integer
     */
    private $brinkerMemberId;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     */
    private $rewardId;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     */
    private $rewardDuration;

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
            'loyaltyID' => $this->brinkerMemberId,
            'rewardId' => $this->rewardId,
            'rewardDuration' => $this->rewardDuration,
            'notes' => $this->notes,
            'user' => $this->user,
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

    public function getRewardId()
    {
        return $this->rewardId;
    }

    public function setRewardId($rewardId)
    {
        $this->rewardId = $rewardId;
    }

    public function getRewardDuration()
    {
        return $this->rewardDuration;
    }

    public function setRewardDuration($rewardDuration)
    {
        $this->rewardDuration = $rewardDuration;
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
