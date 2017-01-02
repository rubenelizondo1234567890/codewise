<?php

namespace RAPP\Bundle\LoyaltyBundle\Model;

class Message
{

    /**
     * @var integer
     */
    private $brinkerMemberId;

    /**
     * @var string
     */
    private $type;

    public function getBrinkerMemberId()
    {
        return $this->brinkerMemberId;
    }

    public function setBrinkerMemberId($brinkerMemberId)
    {
        $this->brinkerMemberId = $brinkerMemberId;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

}
