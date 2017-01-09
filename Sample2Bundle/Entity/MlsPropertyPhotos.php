<?php

namespace RetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyPhotos
 *
 * @ORM\Table(name="property_photos", uniqueConstraints={@ORM\UniqueConstraint(name="uk_mls_rank", columns={"mls_property_id", "rank"}), @ORM\UniqueConstraint(name="uk_nwa_rank", columns={"nwa_property_id", "rank"}), @ORM\UniqueConstraint(name="uk_lse_rank", columns={"lse_property_id", "rank"})})
 * @ORM\Entity
 */
class MlsPropertyPhotos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="mls_property_id", type="integer", nullable=true, options={"unsigned":true})
     */
    private $mlsPropertyId;

    /**
     * @var integer
     *
     * @ORM\Column(name="nwa_property_id", type="integer", nullable=true, options={"unsigned":true})
     */
    private $nwaPropertyId;

    /**
     * @var integer
     *
     * @ORM\Column(name="lse_property_id", type="integer", nullable=true, options={"unsigned":true})
     */
    private $lsePropertyId;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", length=255, nullable=false, options={"fixed":false})
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false, options={"fixed":false})
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rank", type="boolean", nullable=false, options={"unsigned":true})
     */
    private $rank;

    /**
     * @var string
     *
     * @ORM\Column(name="as3_bucket_name", type="string", length=100, nullable=false, options={"fixed":false})
     */
    private $as3BucketName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="check_project_analysis", type="boolean", nullable=true, options={"unsigned":true})
     */
    private $checkProjectAnalysis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_updated", type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mlsPropertyId
     *
     * @param integer $mlsPropertyId
     *
     * @return PropertyPhotos
     */
    public function setMlsPropertyId($mlsPropertyId)
    {
        $this->mlsPropertyId = $mlsPropertyId;

        return $this;
    }

    /**
     * Get mlsPropertyId
     *
     * @return integer
     */
    public function getMlsPropertyId()
    {
        return $this->mlsPropertyId;
    }

    /**
     * Set nwaPropertyId
     *
     * @param integer $nwaPropertyId
     *
     * @return PropertyPhotos
     */
    public function setNwaPropertyId($nwaPropertyId)
    {
        $this->nwaPropertyId = $nwaPropertyId;

        return $this;
    }

    /**
     * Get nwaPropertyId
     *
     * @return integer
     */
    public function getNwaPropertyId()
    {
        return $this->nwaPropertyId;
    }

    /**
     * Set lsePropertyId
     *
     * @param integer $lsePropertyId
     *
     * @return PropertyPhotos
     */
    public function setLsePropertyId($lsePropertyId)
    {
        $this->lsePropertyId = $lsePropertyId;

        return $this;
    }

    /**
     * Get lsePropertyId
     *
     * @return integer
     */
    public function getLsePropertyId()
    {
        return $this->lsePropertyId;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return PropertyPhotos
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PropertyPhotos
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set rank
     *
     * @param boolean $rank
     *
     * @return PropertyPhotos
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return boolean
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set as3BucketName
     *
     * @param string $as3BucketName
     *
     * @return PropertyPhotos
     */
    public function setAs3BucketName($as3BucketName)
    {
        $this->as3BucketName = $as3BucketName;

        return $this;
    }

    /**
     * Get as3BucketName
     *
     * @return string
     */
    public function getAs3BucketName()
    {
        return $this->as3BucketName;
    }

    /**
     * Set checkProjectAnalysis
     *
     * @param boolean $checkProjectAnalysis
     *
     * @return PropertyPhotos
     */
    public function setCheckProjectAnalysis($checkProjectAnalysis)
    {
        $this->checkProjectAnalysis = $checkProjectAnalysis;

        return $this;
    }

    /**
     * Get checkProjectAnalysis
     *
     * @return boolean
     */
    public function getCheckProjectAnalysis()
    {
        return $this->checkProjectAnalysis;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     *
     * @return PropertyPhotos
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return PropertyPhotos
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
}
