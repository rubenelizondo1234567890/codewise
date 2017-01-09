<?php

namespace RAPP\Bundle\LoyaltyBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ChangePin
{

    /**
     * @var integer
     * 
     * @Assert\NotBlank(message="8-digit Loyalty ID required")
     * @Assert\Regex(pattern="/^\d{8}$/", message="Invalid Loyalty ID (must be 8 digits)")
     */
    private $brinkerMemberId;

    /**
     * @var string
     * 
     * @Assert\Regex(pattern="/^\d{4}$/", message="Invalid PIN (must be 4 digits)")
     */
    private $newPin;

    /**
     * @var string
     *
     */
    private $notes;

    
    public function jsonSerialize()
    {
        return array(
            'loyaltyID' => $this->brinkerMemberId,
            'pin' => $this->newPin
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

    public function getNewPin()
    {
        return $this->newPin;
    }

    public function setNewPin($newPin)
    {
        $this->newPin = $newPin;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }
}
