<?php

namespace RetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RetsServers
 *
 * @ORM\Table(name="rets_servers")
 * @ORM\Entity(repositoryClass="RetsBundle\Repository\RetsServersRepository")
 */
class RetsServers
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
     * @ORM\Column(name="state_shortcut_name", type="string", length=2)
     */
    private $stateShortcutName;

    /**
     * @var string
     *
     * @ORM\Column(name="state_name", type="string", length=255)
     */
    private $stateName;

    /**
     * @var string
     *
     * @ORM\Column(name="server_url", type="string", length=255)
     */
    private $serverUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="server_username", type="string", length=255)
     */
    private $serverUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="server_password", type="string", length=255)
     */
    private $serverPassword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

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
     * Set stateShortcutName
     *
     * @param string $stateShortcutName
     *
     * @return RetsServers
     */
    public function setStateShortcutName($stateShortcutName)
    {
        $this->stateShortcutName = $stateShortcutName;

        return $this;
    }

    /**
     * Get stateShortcutName
     *
     * @return string
     */
    public function getStateShortcutName()
    {
        return $this->stateShortcutName;
    }

    /**
     * Set stateName
     *
     * @param string $stateName
     *
     * @return RetsServers
     */
    public function setStateName($stateName)
    {
        $this->stateName = $stateName;

        return $this;
    }

    /**
     * Get stateName
     *
     * @return string
     */
    public function getStateName()
    {
        return $this->stateName;
    }

    /**
     * Set serverUrl
     *
     * @param string $serverUrl
     *
     * @return RetsServers
     */
    public function setServerUrl($serverUrl)
    {
        $this->serverUrl = $serverUrl;

        return $this;
    }

    /**
     * Get serverUrl
     *
     * @return string
     */
    public function getServerUrl()
    {
        return $this->serverUrl;
    }

    /**
     * Set serverUsername
     *
     * @param string $serverUsername
     *
     * @return RetsServers
     */
    public function setServerUsername($serverUsername)
    {
        $this->serverUsername = $serverUsername;

        return $this;
    }

    /**
     * Get serverUsername
     *
     * @return string
     */
    public function getServerUsername()
    {
        return $this->serverUsername;
    }

    /**
     * Set serverPassword
     *
     * @param string $serverPassword
     *
     * @return RetsServers
     */
    public function setServerPassword($serverPassword)
    {
        $this->serverPassword = $serverPassword;

        return $this;
    }

    /**
     * Get serverPassword
     *
     * @return string
     */
    public function getServerPassword()
    {
        return $this->serverPassword;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return RetsServers
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return RetsServers
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
