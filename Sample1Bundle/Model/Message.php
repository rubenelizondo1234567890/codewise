<?php

namespace codewise\Bundle\LoyaltyBundle\Model;

class Message
{

    /**
     * @var integer
     */
    private $codewiseMemberId;

    /**
     * @var string
     */
    private $type;

    public function getcodewiseMemberId()
    {
        return $this->codewiseMemberId;
    }

    public function setcodewiseMemberId($codewiseMemberId)
    {
        $this->codewiseMemberId = $codewiseMemberId;
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
