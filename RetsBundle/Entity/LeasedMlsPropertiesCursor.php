<?php

namespace RetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LeasedMlsPropertiesCursor
 *
 * @ORM\Table(name="leased_mls_properties_cursor")
 * @ORM\Entity(repositoryClass="RetsBundle\Repository\LeasedMlsPropertiesCursorRepository")
 */
class LeasedMlsPropertiesCursor
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
     * @ORM\Column(name="market_short_name", type="string", length=255)
     */
    private $marketShortName;

    /**
     * @var string
     *
     * @ORM\Column(name="market_long_name", type="string", length=255)
     */
    private $marketLongName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cursor_time_stamp", type="datetime")
     */
    private $cursorTimeStamp;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;


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
     * Set marketShortName
     *
     * @param string $marketShortName
     *
     * @return MlsPropertiesCursor
     */
    public function setMarketShortName($marketShortName)
    {
        $this->marketShortName = $marketShortName;

        return $this;
    }

    /**
     * Get marketShortName
     *
     * @return string
     */
    public function getMarketShortName()
    {
        return $this->marketShortName;
    }

    /**
     * Set marketLongName
     *
     * @param string $marketLongName
     *
     * @return MlsPropertiesCursor
     */
    public function setMarketLongName($marketLongName)
    {
        $this->marketLongName = $marketLongName;

        return $this;
    }

    /**
     * Get marketLongName
     *
     * @return string
     */
    public function getMarketLongName()
    {
        return $this->marketLongName;
    }

    /**
     * Set cursorTimeStamp
     *
     * @param \DateTime $cursorTimeStamp
     *
     * @return MlsPropertiesCursor
     */
    public function setCursorTimeStamp($cursorTimeStamp)
    {
        $this->cursorTimeStamp = $cursorTimeStamp;

        return $this;
    }

    /**
     * Get cursorTimeStamp
     *
     * @return \DateTime
     */
    public function getCursorTimeStamp()
    {
        return $this->cursorTimeStamp;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return MlsPropertiesCursor
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }
}
