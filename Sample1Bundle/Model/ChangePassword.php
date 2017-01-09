<?php

namespace codewise\Bundle\LoyaltyBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword
{

    /**
     * @var integer
     * 
     * @Assert\NotBlank(message="8-digit Loyalty ID required")
     * @Assert\Regex(pattern="/^\d{8}$/", message="Invalid Loyalty ID (must be 8 digits)")
     */
    private $codewiseMemberId;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Password Required")
     * @Assert\Length(min = 6, minMessage = "Invalid Password (must be 6 characters)")
     * @Assert\Regex(pattern = "/\d/", message = "Invalid Password (must contain 1 number)")
     * )
     */
    private $newPassword;

    /**
     * @var string
     *
     */
    private $notes;

    
    public function jsonSerialize()
    {
        return array(
            'loyaltyID' => $this->codewiseMemberId,
            'password' => $this->newPassword
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

    public function getNewPassword()
    {
        return $this->newPassword;
    }

    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;
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
