<?php

namespace RetsBundle\Adapter;

use RetsBundle\Adapter\mlsMapperInterface;

/**
 * mlsLeasedMapper
 * Base class to map Leased MLS raw data from different RETS Servers to Heartland MlsProperties
 * Each Market extends this to map particular raw data in a standarized model
 */
abstract class mlsLeasedMapper implements mlsMapperInterface
{
    /**
     * @var integer
     *
     */
    protected $id;

    /**
     * @var integer
     *
     */
    protected $marketId;

    /**
     * @var \DateTime
     *
     */
    protected $dateCreated;

    /**
     * @var \DateTime
     *
     */
    protected $dateUpdated;

    /**
     * @var \DateTime
     *
     */
    protected $dateAlvCalculated;

    /**
     * @var boolean
     *
     */
    protected $needsAlvCalculation;

    /**
     * @var string
     *
     */
    protected $latitude;

    /**
     * @var string
     *
     */
    protected $longitude;

    /**
     * @var string
     *
     */
    protected $photoId;

    /**
     * @var string
     *
     */
    protected $photoFile;

    /**
     * @var boolean
     *
     */
    protected $photoCount;

    /**
     * @var \DateTime
     *
     */
    protected $photoUpdated;

    /**
     * @var \DateTime
     *
     */
    protected $photoModified;

    /**
     * @var string
     *
     */
    protected $mlsnum;

    /**
     * @var \DateTime
     *
     */
    protected $modified;

    /**
     * @var string
     *
     */
    protected $liststatus;

    /**
     * @var integer
     *
     */
    protected $salesprice;

    /**
     * @var integer
     *
     */
    protected $listprice;

    /**
     * @var integer
     *
     */
    protected $listpriceorig;

    /**
     * @var integer
     *
     */
    protected $listpricelow;

    /**
     * @var string
     *
     */
    protected $sqftprice;

    /**
     * @var string
     *
     */
    protected $sqftpricesold;

    /**
     * @var integer
     *
     */
    protected $sqfttotal;

    /**
     * @var \DateTime
     *
     */
    protected $statuschangedate;

    /**
     * @var \DateTime
     *
     */
    protected $listdate;

    /**
     * @var \DateTime
     *
     */
    protected $pendingdate;

    /**
     * @var \DateTime
     *
     */
    protected $closeddate;

    /**
     * @var \DateTime
     *
     */
    protected $expiredateoption;

    /**
     * @var string
     *
     */
    protected $area;

    /**
     * @var string
     *
     */
    protected $state;

    /**
     * @var string
     *
     */
    protected $county;

    /**
     * @var string
     *
     */
    protected $mapbook;

    /**
     * @var string
     *
     */
    protected $mappage;

    /**
     * @var string
     *
     */
    protected $mapcoord;

    /**
     * @var string
     *
     */
    protected $zipcode;

    /**
     * @var string
     *
     */
    protected $city;

    /**
     * @var string
     *
     */
    protected $streettype;

    /**
     * @var string
     *
     */
    protected $streetname;

    /**
     * @var integer
     *
     */
    protected $streetnum;

    /**
     * @var string
     *
     */
    protected $streetnumdisplay;

    /**
     * @var string
     *
     */
    protected $officelist;

    /**
     * @var string
     *
     */
    protected $officelistOfficenam1;

    /**
     * @var string
     *
     */
    protected $officelistAddress;

    /**
     * @var string
     *
     */
    protected $officelistAddress2;

    /**
     * @var string
     *
     */
    protected $officelistPhon1;

    /**
     * @var string
     *
     */
    protected $officelistFax;

    /**
     * @var string
     *
     */
    protected $officelistCity;

    /**
     * @var string
     *
     */
    protected $officelistZip;

    /**
     * @var string
     *
     */
    protected $officelistState;

    /**
     * @var string
     *
     */
    protected $officelistWeb;

    /**
     * @var string
     *
     */
    protected $officesellOfficenam2;

    /**
     * @var string
     *
     */
    protected $officesell;

    /**
     * @var string
     *
     */
    protected $officesellPhon2;

    /**
     * @var string
     *
     */
    protected $housingtype;

    /**
     * @var string
     *
     */
    protected $propsubtype;

    /**
     * @var string
     *
     */
    protected $condoyn;

    /**
     * @var integer
     *
     */
    protected $yearbuilt;

    /**
     * @var string
     *
     */
    protected $liststatusflag;

    /**
     * @var string
     *
     */
    protected $agentlist;

    /**
     * @var string
     *
     */
    protected $agentlistFullname;

    /**
     * @var string
     *
     */
    protected $agentlistFirstname;

    /**
     * @var string
     *
     */
    protected $agentlistLastname;

    /**
     * @var string
     *
     */
    protected $agentlistFax;

    /**
     * @var string
     *
     */
    protected $agentlistPhone;

    /**
     * @var string
     *
     */
    protected $agentlistMobilenum1;

    /**
     * @var string
     *
     */
    protected $agentlistEmail;

    /**
     * @var string
     *
     */
    protected $agentlistVoicmail1;

    /**
     * @var string
     *
     */
    protected $agentlistPagernum1;

    /**
     * @var string
     *
     */
    protected $agentlistWeb;

    /**
     * @var string
     *
     */
    protected $heatsystem;

    /**
     * @var integer
     *
     */
    protected $assocfee;

    /**
     * @var string
     *
     */
    protected $compsell;

    /**
     * @var string
     *
     */
    protected $assocfeepaid;

    /**
     * @var string
     *
     */
    protected $block;

    /**
     * @var integer
     *
     */
    protected $cdom;

    /**
     * @var string
     *
     */
    protected $directions;

    /**
     * @var string
     *
     */
    protected $subdivision;

    /**
     * @var string
     *
     */
    protected $compbuy;

    /**
     * @var integer
     *
     */
    protected $daysonmarket;

    /**
     * @var integer
     *
     */
    protected $bathshalf;

    /**
     * @var integer
     *
     */
    protected $beds;

    /**
     * @var string
     *
     */
    protected $bathstotal;

    /**
     * @var string
     *
     */
    protected $style;

    /**
     * @var string
     *
     */
    protected $acres;

    /**
     * @var string
     *
     */
    protected $exterior;

    /**
     * @var string
     *
     */
    protected $fireplacedesc;

    /**
     * @var string
     *
     */
    protected $interior;

    /**
     * @var string
     *
     */
    protected $occupancy;

    /**
     * @var string
     *
     */
    protected $remarks;

    /**
     * @var string
     *
     */
    protected $realremarks;

    /**
     * @var string
     *
     */
    protected $showinstr;

    /**
     * @var string
     *
     */
    protected $construction;

    /**
     * @var string
     *
     */
    protected $hoa;

    /**
     * @var integer
     *
     */
    protected $stories;

    /**
     * @var string
     *
     */
    protected $unitnum;

    /**
     * @var string
     *
     */
    protected $taxid;

    /**
     * @var string
     *
     */
    protected $lotnum;

    /**
     * @var string
     *
     */
    protected $lotsize;

    /**
     * @var string
     *
     */
    protected $lotdim;

    /**
     * @var integer
     *
     */
    protected $bathsfull;

    /**
     * @var string
     *
     */
    protected $ownerName;

    /**
     * @var string
     *
     */
    protected $agentsell;

    /**
     * @var string
     *
     */
    protected $agentsellAgentname;

    /**
     * @var string
     *
     */
    protected $sellerType;

    /**
     * @var string
     *
     */
    protected $streetdirPrefix;

    /**
     * @var string
     *
     */
    protected $streetdirSuffix;



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
     * Set marketId
     *
     * @param integer $marketId
     *
     * @return MlsLeaseProperties
     */
    public function setMarketId($marketId)
    {
        $this->marketId = $marketId;

        return $this;
    }

    /**
     * Get marketId
     *
     * @return integer
     */
    public function getMarketId()
    {
        return $this->marketId;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return MlsLeaseProperties
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
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     *
     * @return MlsLeaseProperties
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
     * Set dateAlvCalculated
     *
     * @param \DateTime $dateAlvCalculated
     *
     * @return MlsLeaseProperties
     */
    public function setDateAlvCalculated($dateAlvCalculated)
    {
        $this->dateAlvCalculated = $dateAlvCalculated;

        return $this;
    }

    /**
     * Get dateAlvCalculated
     *
     * @return \DateTime
     */
    public function getDateAlvCalculated()
    {
        return $this->dateAlvCalculated;
    }

    /**
     * Set needsAlvCalculation
     *
     * @param boolean $needsAlvCalculation
     *
     * @return MlsLeaseProperties
     */
    public function setNeedsAlvCalculation($needsAlvCalculation)
    {
        $this->needsAlvCalculation = $needsAlvCalculation;

        return $this;
    }

    /**
     * Get needsAlvCalculation
     *
     * @return boolean
     */
    public function getNeedsAlvCalculation()
    {
        return $this->needsAlvCalculation;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return MlsLeaseProperties
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return MlsLeaseProperties
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set photoId
     *
     * @param string $photoId
     *
     * @return MlsLeaseProperties
     */
    public function setPhotoId($photoId)
    {
        $this->photoId = $photoId;

        return $this;
    }

    /**
     * Get photoId
     *
     * @return string
     */
    public function getPhotoId()
    {
        return $this->photoId;
    }

    /**
     * Set photoFile
     *
     * @param string $photoFile
     *
     * @return MlsLeaseProperties
     */
    public function setPhotoFile($photoFile)
    {
        $this->photoFile = $photoFile;

        return $this;
    }

    /**
     * Get photoFile
     *
     * @return string
     */
    public function getPhotoFile()
    {
        return $this->photoFile;
    }

    /**
     * Set photoCount
     *
     * @param boolean $photoCount
     *
     * @return MlsLeaseProperties
     */
    public function setPhotoCount($photoCount)
    {
        $this->photoCount = $photoCount;

        return $this;
    }

    /**
     * Get photoCount
     *
     * @return boolean
     */
    public function getPhotoCount()
    {
        return $this->photoCount;
    }

    /**
     * Set photoUpdated
     *
     * @param \DateTime $photoUpdated
     *
     * @return MlsLeaseProperties
     */
    public function setPhotoUpdated($photoUpdated)
    {
        $this->photoUpdated = $photoUpdated;

        return $this;
    }

    /**
     * Get photoUpdated
     *
     * @return \DateTime
     */
    public function getPhotoUpdated()
    {
        return $this->photoUpdated;
    }

    /**
     * Set photoModified
     *
     * @param \DateTime $photoModified
     *
     * @return MlsLeaseProperties
     */
    public function setPhotoModified($photoModified)
    {
        $this->photoModified = $photoModified;

        return $this;
    }

    /**
     * Get photoModified
     *
     * @return \DateTime
     */
    public function getPhotoModified()
    {
        return $this->photoModified;
    }

    /**
     * Set mlsnum
     *
     * @param string $mlsnum
     *
     * @return MlsLeaseProperties
     */
    public function setMlsnum($mlsnum)
    {
        $this->mlsnum = $mlsnum;

        return $this;
    }

    /**
     * Get mlsnum
     *
     * @return string
     */
    public function getMlsnum()
    {
        return $this->mlsnum;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     *
     * @return MlsLeaseProperties
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set liststatus
     *
     * @param string $liststatus
     *
     * @return MlsLeaseProperties
     */
    public function setListstatus($liststatus)
    {
        $this->liststatus = $liststatus;

        return $this;
    }

    /**
     * Get liststatus
     *
     * @return string
     */
    public function getListstatus()
    {
        return $this->liststatus;
    }

    /**
     * Set salesprice
     *
     * @param integer $salesprice
     *
     * @return MlsLeaseProperties
     */
    public function setSalesprice($salesprice)
    {
        $this->salesprice = $salesprice;

        return $this;
    }

    /**
     * Get salesprice
     *
     * @return integer
     */
    public function getSalesprice()
    {
        return $this->salesprice;
    }

    /**
     * Set listprice
     *
     * @param integer $listprice
     *
     * @return MlsLeaseProperties
     */
    public function setListprice($listprice)
    {
        $this->listprice = $listprice;

        return $this;
    }

    /**
     * Get listprice
     *
     * @return integer
     */
    public function getListprice()
    {
        return $this->listprice;
    }

    /**
     * Set listpriceorig
     *
     * @param integer $listpriceorig
     *
     * @return MlsLeaseProperties
     */
    public function setListpriceorig($listpriceorig)
    {
        $this->listpriceorig = $listpriceorig;

        return $this;
    }

    /**
     * Get listpriceorig
     *
     * @return integer
     */
    public function getListpriceorig()
    {
        return $this->listpriceorig;
    }

    /**
     * Set listpricelow
     *
     * @param integer $listpricelow
     *
     * @return MlsLeaseProperties
     */
    public function setListpricelow($listpricelow)
    {
        $this->listpricelow = $listpricelow;

        return $this;
    }

    /**
     * Get listpricelow
     *
     * @return integer
     */
    public function getListpricelow()
    {
        return $this->listpricelow;
    }

    /**
     * Set sqftprice
     *
     * @param string $sqftprice
     *
     * @return MlsLeaseProperties
     */
    public function setSqftprice($sqftprice)
    {
        $this->sqftprice = $sqftprice;

        return $this;
    }

    /**
     * Get sqftprice
     *
     * @return string
     */
    public function getSqftprice()
    {
        return $this->sqftprice;
    }

    /**
     * Set sqftpricesold
     *
     * @param string $sqftpricesold
     *
     * @return MlsLeaseProperties
     */
    public function setSqftpricesold($sqftpricesold)
    {
        $this->sqftpricesold = $sqftpricesold;

        return $this;
    }

    /**
     * Get sqftpricesold
     *
     * @return string
     */
    public function getSqftpricesold()
    {
        return $this->sqftpricesold;
    }

    /**
     * Set sqfttotal
     *
     * @param integer $sqfttotal
     *
     * @return MlsLeaseProperties
     */
    public function setSqfttotal($sqfttotal)
    {
        $this->sqfttotal = $sqfttotal;

        return $this;
    }

    /**
     * Get sqfttotal
     *
     * @return integer
     */
    public function getSqfttotal()
    {
        return $this->sqfttotal;
    }

    /**
     * Set statuschangedate
     *
     * @param \DateTime $statuschangedate
     *
     * @return MlsLeaseProperties
     */
    public function setStatuschangedate($statuschangedate)
    {
        $this->statuschangedate = $statuschangedate;

        return $this;
    }

    /**
     * Get statuschangedate
     *
     * @return \DateTime
     */
    public function getStatuschangedate()
    {
        return $this->statuschangedate;
    }

    /**
     * Set listdate
     *
     * @param \DateTime $listdate
     *
     * @return MlsLeaseProperties
     */
    public function setListdate($listdate)
    {
        $this->listdate = $listdate;

        return $this;
    }

    /**
     * Get listdate
     *
     * @return \DateTime
     */
    public function getListdate()
    {
        return $this->listdate;
    }

    /**
     * Set pendingdate
     *
     * @param \DateTime $pendingdate
     *
     * @return MlsLeaseProperties
     */
    public function setPendingdate($pendingdate)
    {
        $this->pendingdate = $pendingdate;

        return $this;
    }

    /**
     * Get pendingdate
     *
     * @return \DateTime
     */
    public function getPendingdate()
    {
        return $this->pendingdate;
    }

    /**
     * Set closeddate
     *
     * @param \DateTime $closeddate
     *
     * @return MlsLeaseProperties
     */
    public function setCloseddate($closeddate)
    {
        $this->closeddate = $closeddate;

        return $this;
    }

    /**
     * Get closeddate
     *
     * @return \DateTime
     */
    public function getCloseddate()
    {
        return $this->closeddate;
    }

    /**
     * Set expiredateoption
     *
     * @param \DateTime $expiredateoption
     *
     * @return MlsLeaseProperties
     */
    public function setExpiredateoption($expiredateoption)
    {
        $this->expiredateoption = $expiredateoption;

        return $this;
    }

    /**
     * Get expiredateoption
     *
     * @return \DateTime
     */
    public function getExpiredateoption()
    {
        return $this->expiredateoption;
    }

    /**
     * Set area
     *
     * @param string $area
     *
     * @return MlsLeaseProperties
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return MlsLeaseProperties
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set county
     *
     * @param string $county
     *
     * @return MlsLeaseProperties
     */
    public function setCounty($county)
    {
        $this->county = $county;

        return $this;
    }

    /**
     * Get county
     *
     * @return string
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * Set mapbook
     *
     * @param string $mapbook
     *
     * @return MlsLeaseProperties
     */
    public function setMapbook($mapbook)
    {
        $this->mapbook = $mapbook;

        return $this;
    }

    /**
     * Get mapbook
     *
     * @return string
     */
    public function getMapbook()
    {
        return $this->mapbook;
    }

    /**
     * Set mappage
     *
     * @param string $mappage
     *
     * @return MlsLeaseProperties
     */
    public function setMappage($mappage)
    {
        $this->mappage = $mappage;

        return $this;
    }

    /**
     * Get mappage
     *
     * @return string
     */
    public function getMappage()
    {
        return $this->mappage;
    }

    /**
     * Set mapcoord
     *
     * @param string $mapcoord
     *
     * @return MlsLeaseProperties
     */
    public function setMapcoord($mapcoord)
    {
        $this->mapcoord = $mapcoord;

        return $this;
    }

    /**
     * Get mapcoord
     *
     * @return string
     */
    public function getMapcoord()
    {
        return $this->mapcoord;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return MlsLeaseProperties
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return MlsLeaseProperties
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set streettype
     *
     * @param string $streettype
     *
     * @return MlsLeaseProperties
     */
    public function setStreettype($streettype)
    {
        $this->streettype = $streettype;

        return $this;
    }

    /**
     * Get streettype
     *
     * @return string
     */
    public function getStreettype()
    {
        return $this->streettype;
    }

    /**
     * Set streetname
     *
     * @param string $streetname
     *
     * @return MlsLeaseProperties
     */
    public function setStreetname($streetname)
    {
        $this->streetname = $streetname;

        return $this;
    }

    /**
     * Get streetname
     *
     * @return string
     */
    public function getStreetname()
    {
        return $this->streetname;
    }

    /**
     * Set streetnum
     *
     * @param integer $streetnum
     *
     * @return MlsLeaseProperties
     */
    public function setStreetnum($streetnum)
    {
        $this->streetnum = $streetnum;

        return $this;
    }

    /**
     * Get streetnum
     *
     * @return integer
     */
    public function getStreetnum()
    {
        return $this->streetnum;
    }

    /**
     * Set streetnumdisplay
     *
     * @param string $streetnumdisplay
     *
     * @return MlsLeaseProperties
     */
    public function setStreetnumdisplay($streetnumdisplay)
    {
        $this->streetnumdisplay = $streetnumdisplay;

        return $this;
    }

    /**
     * Get streetnumdisplay
     *
     * @return string
     */
    public function getStreetnumdisplay()
    {
        return $this->streetnumdisplay;
    }

    /**
     * Set officelist
     *
     * @param string $officelist
     *
     * @return MlsLeaseProperties
     */
    public function setOfficelist($officelist)
    {
        $this->officelist = $officelist;

        return $this;
    }

    /**
     * Get officelist
     *
     * @return string
     */
    public function getOfficelist()
    {
        return $this->officelist;
    }

    /**
     * Set officelistOfficenam1
     *
     * @param string $officelistOfficenam1
     *
     * @return MlsLeaseProperties
     */
    public function setOfficelistOfficenam1($officelistOfficenam1)
    {
        $this->officelistOfficenam1 = $officelistOfficenam1;

        return $this;
    }

    /**
     * Get officelistOfficenam1
     *
     * @return string
     */
    public function getOfficelistOfficenam1()
    {
        return $this->officelistOfficenam1;
    }

    /**
     * Set officelistAddress
     *
     * @param string $officelistAddress
     *
     * @return MlsLeaseProperties
     */
    public function setOfficelistAddress($officelistAddress)
    {
        $this->officelistAddress = $officelistAddress;

        return $this;
    }

    /**
     * Get officelistAddress
     *
     * @return string
     */
    public function getOfficelistAddress()
    {
        return $this->officelistAddress;
    }

    /**
     * Set officelistAddress2
     *
     * @param string $officelistAddress2
     *
     * @return MlsLeaseProperties
     */
    public function setOfficelistAddress2($officelistAddress2)
    {
        $this->officelistAddress2 = $officelistAddress2;

        return $this;
    }

    /**
     * Get officelistAddress2
     *
     * @return string
     */
    public function getOfficelistAddress2()
    {
        return $this->officelistAddress2;
    }

    /**
     * Set officelistPhon1
     *
     * @param string $officelistPhon1
     *
     * @return MlsLeaseProperties
     */
    public function setOfficelistPhon1($officelistPhon1)
    {
        $this->officelistPhon1 = $officelistPhon1;

        return $this;
    }

    /**
     * Get officelistPhon1
     *
     * @return string
     */
    public function getOfficelistPhon1()
    {
        return $this->officelistPhon1;
    }

    /**
     * Set officelistFax
     *
     * @param string $officelistFax
     *
     * @return MlsLeaseProperties
     */
    public function setOfficelistFax($officelistFax)
    {
        $this->officelistFax = $officelistFax;

        return $this;
    }

    /**
     * Get officelistFax
     *
     * @return string
     */
    public function getOfficelistFax()
    {
        return $this->officelistFax;
    }

    /**
     * Set officelistCity
     *
     * @param string $officelistCity
     *
     * @return MlsLeaseProperties
     */
    public function setOfficelistCity($officelistCity)
    {
        $this->officelistCity = $officelistCity;

        return $this;
    }

    /**
     * Get officelistCity
     *
     * @return string
     */
    public function getOfficelistCity()
    {
        return $this->officelistCity;
    }

    /**
     * Set officelistZip
     *
     * @param string $officelistZip
     *
     * @return MlsLeaseProperties
     */
    public function setOfficelistZip($officelistZip)
    {
        $this->officelistZip = $officelistZip;

        return $this;
    }

    /**
     * Get officelistZip
     *
     * @return string
     */
    public function getOfficelistZip()
    {
        return $this->officelistZip;
    }

    /**
     * Set officelistState
     *
     * @param string $officelistState
     *
     * @return MlsLeaseProperties
     */
    public function setOfficelistState($officelistState)
    {
        $this->officelistState = $officelistState;

        return $this;
    }

    /**
     * Get officelistState
     *
     * @return string
     */
    public function getOfficelistState()
    {
        return $this->officelistState;
    }

    /**
     * Set officelistWeb
     *
     * @param string $officelistWeb
     *
     * @return MlsLeaseProperties
     */
    public function setOfficelistWeb($officelistWeb)
    {
        $this->officelistWeb = $officelistWeb;

        return $this;
    }

    /**
     * Get officelistWeb
     *
     * @return string
     */
    public function getOfficelistWeb()
    {
        return $this->officelistWeb;
    }

    /**
     * Set officesellOfficenam2
     *
     * @param string $officesellOfficenam2
     *
     * @return MlsLeaseProperties
     */
    public function setOfficesellOfficenam2($officesellOfficenam2)
    {
        $this->officesellOfficenam2 = $officesellOfficenam2;

        return $this;
    }

    /**
     * Get officesellOfficenam2
     *
     * @return string
     */
    public function getOfficesellOfficenam2()
    {
        return $this->officesellOfficenam2;
    }

    /**
     * Set officesell
     *
     * @param string $officesell
     *
     * @return MlsLeaseProperties
     */
    public function setOfficesell($officesell)
    {
        $this->officesell = $officesell;

        return $this;
    }

    /**
     * Get officesell
     *
     * @return string
     */
    public function getOfficesell()
    {
        return $this->officesell;
    }

    /**
     * Set officesellPhon2
     *
     * @param string $officesellPhon2
     *
     * @return MlsLeaseProperties
     */
    public function setOfficesellPhon2($officesellPhon2)
    {
        $this->officesellPhon2 = $officesellPhon2;

        return $this;
    }

    /**
     * Get officesellPhon2
     *
     * @return string
     */
    public function getOfficesellPhon2()
    {
        return $this->officesellPhon2;
    }

    /**
     * Set housingtype
     *
     * @param string $housingtype
     *
     * @return MlsLeaseProperties
     */
    public function setHousingtype($housingtype)
    {
        $this->housingtype = $housingtype;

        return $this;
    }

    /**
     * Get housingtype
     *
     * @return string
     */
    public function getHousingtype()
    {
        return $this->housingtype;
    }

    /**
     * Set propsubtype
     *
     * @param string $propsubtype
     *
     * @return MlsLeaseProperties
     */
    public function setPropsubtype($propsubtype)
    {
        $this->propsubtype = $propsubtype;

        return $this;
    }

    /**
     * Get propsubtype
     *
     * @return string
     */
    public function getPropsubtype()
    {
        return $this->propsubtype;
    }

    /**
     * Set condoyn
     *
     * @param string $condoyn
     *
     * @return MlsLeaseProperties
     */
    public function setCondoyn($condoyn)
    {
        $this->condoyn = $condoyn;

        return $this;
    }

    /**
     * Get condoyn
     *
     * @return string
     */
    public function getCondoyn()
    {
        return $this->condoyn;
    }

    /**
     * Set yearbuilt
     *
     * @param integer $yearbuilt
     *
     * @return MlsLeaseProperties
     */
    public function setYearbuilt($yearbuilt)
    {
        $this->yearbuilt = $yearbuilt;

        return $this;
    }

    /**
     * Get yearbuilt
     *
     * @return integer
     */
    public function getYearbuilt()
    {
        return $this->yearbuilt;
    }

    /**
     * Set liststatusflag
     *
     * @param string $liststatusflag
     *
     * @return MlsLeaseProperties
     */
    public function setListstatusflag($liststatusflag)
    {
        $this->liststatusflag = $liststatusflag;

        return $this;
    }

    /**
     * Get liststatusflag
     *
     * @return string
     */
    public function getListstatusflag()
    {
        return $this->liststatusflag;
    }

    /**
     * Set agentlist
     *
     * @param string $agentlist
     *
     * @return MlsLeaseProperties
     */
    public function setAgentlist($agentlist)
    {
        $this->agentlist = $agentlist;

        return $this;
    }

    /**
     * Get agentlist
     *
     * @return string
     */
    public function getAgentlist()
    {
        return $this->agentlist;
    }

    /**
     * Set agentlistFullname
     *
     * @param string $agentlistFullname
     *
     * @return MlsLeaseProperties
     */
    public function setAgentlistFullname($agentlistFullname)
    {
        $this->agentlistFullname = $agentlistFullname;

        return $this;
    }

    /**
     * Get agentlistFullname
     *
     * @return string
     */
    public function getAgentlistFullname()
    {
        return $this->agentlistFullname;
    }

    /**
     * Set agentlistFirstname
     *
     * @param string $agentlistFirstname
     *
     * @return MlsLeaseProperties
     */
    public function setAgentlistFirstname($agentlistFirstname)
    {
        $this->agentlistFirstname = $agentlistFirstname;

        return $this;
    }

    /**
     * Get agentlistFirstname
     *
     * @return string
     */
    public function getAgentlistFirstname()
    {
        return $this->agentlistFirstname;
    }

    /**
     * Set agentlistLastname
     *
     * @param string $agentlistLastname
     *
     * @return MlsLeaseProperties
     */
    public function setAgentlistLastname($agentlistLastname)
    {
        $this->agentlistLastname = $agentlistLastname;

        return $this;
    }

    /**
     * Get agentlistLastname
     *
     * @return string
     */
    public function getAgentlistLastname()
    {
        return $this->agentlistLastname;
    }

    /**
     * Set agentlistFax
     *
     * @param string $agentlistFax
     *
     * @return MlsLeaseProperties
     */
    public function setAgentlistFax($agentlistFax)
    {
        $this->agentlistFax = $agentlistFax;

        return $this;
    }

    /**
     * Get agentlistFax
     *
     * @return string
     */
    public function getAgentlistFax()
    {
        return $this->agentlistFax;
    }

    /**
     * Set agentlistPhone
     *
     * @param string $agentlistPhone
     *
     * @return MlsLeaseProperties
     */
    public function setAgentlistPhone($agentlistPhone)
    {
        $this->agentlistPhone = $agentlistPhone;

        return $this;
    }

    /**
     * Get agentlistPhone
     *
     * @return string
     */
    public function getAgentlistPhone()
    {
        return $this->agentlistPhone;
    }

    /**
     * Set agentlistMobilenum1
     *
     * @param string $agentlistMobilenum1
     *
     * @return MlsLeaseProperties
     */
    public function setAgentlistMobilenum1($agentlistMobilenum1)
    {
        $this->agentlistMobilenum1 = $agentlistMobilenum1;

        return $this;
    }

    /**
     * Get agentlistMobilenum1
     *
     * @return string
     */
    public function getAgentlistMobilenum1()
    {
        return $this->agentlistMobilenum1;
    }

    /**
     * Set agentlistEmail
     *
     * @param string $agentlistEmail
     *
     * @return MlsLeaseProperties
     */
    public function setAgentlistEmail($agentlistEmail)
    {
        $this->agentlistEmail = $agentlistEmail;

        return $this;
    }

    /**
     * Get agentlistEmail
     *
     * @return string
     */
    public function getAgentlistEmail()
    {
        return $this->agentlistEmail;
    }

    /**
     * Set agentlistVoicmail1
     *
     * @param string $agentlistVoicmail1
     *
     * @return MlsLeaseProperties
     */
    public function setAgentlistVoicmail1($agentlistVoicmail1)
    {
        $this->agentlistVoicmail1 = $agentlistVoicmail1;

        return $this;
    }

    /**
     * Get agentlistVoicmail1
     *
     * @return string
     */
    public function getAgentlistVoicmail1()
    {
        return $this->agentlistVoicmail1;
    }

    /**
     * Set agentlistPagernum1
     *
     * @param string $agentlistPagernum1
     *
     * @return MlsLeaseProperties
     */
    public function setAgentlistPagernum1($agentlistPagernum1)
    {
        $this->agentlistPagernum1 = $agentlistPagernum1;

        return $this;
    }

    /**
     * Get agentlistPagernum1
     *
     * @return string
     */
    public function getAgentlistPagernum1()
    {
        return $this->agentlistPagernum1;
    }

    /**
     * Set agentlistWeb
     *
     * @param string $agentlistWeb
     *
     * @return MlsLeaseProperties
     */
    public function setAgentlistWeb($agentlistWeb)
    {
        $this->agentlistWeb = $agentlistWeb;

        return $this;
    }

    /**
     * Get agentlistWeb
     *
     * @return string
     */
    public function getAgentlistWeb()
    {
        return $this->agentlistWeb;
    }

    /**
     * Set heatsystem
     *
     * @param string $heatsystem
     *
     * @return MlsLeaseProperties
     */
    public function setHeatsystem($heatsystem)
    {
        $this->heatsystem = $heatsystem;

        return $this;
    }

    /**
     * Get heatsystem
     *
     * @return string
     */
    public function getHeatsystem()
    {
        return $this->heatsystem;
    }

    /**
     * Set assocfee
     *
     * @param integer $assocfee
     *
     * @return MlsLeaseProperties
     */
    public function setAssocfee($assocfee)
    {
        $this->assocfee = $assocfee;

        return $this;
    }

    /**
     * Get assocfee
     *
     * @return integer
     */
    public function getAssocfee()
    {
        return $this->assocfee;
    }

    /**
     * Set compsell
     *
     * @param string $compsell
     *
     * @return MlsLeaseProperties
     */
    public function setCompsell($compsell)
    {
        $this->compsell = $compsell;

        return $this;
    }

    /**
     * Get compsell
     *
     * @return string
     */
    public function getCompsell()
    {
        return $this->compsell;
    }

    /**
     * Set assocfeepaid
     *
     * @param string $assocfeepaid
     *
     * @return MlsLeaseProperties
     */
    public function setAssocfeepaid($assocfeepaid)
    {
        $this->assocfeepaid = $assocfeepaid;

        return $this;
    }

    /**
     * Get assocfeepaid
     *
     * @return string
     */
    public function getAssocfeepaid()
    {
        return $this->assocfeepaid;
    }

    /**
     * Set block
     *
     * @param string $block
     *
     * @return MlsLeaseProperties
     */
    public function setBlock($block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return string
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set cdom
     *
     * @param integer $cdom
     *
     * @return MlsLeaseProperties
     */
    public function setCdom($cdom)
    {
        $this->cdom = $cdom;

        return $this;
    }

    /**
     * Get cdom
     *
     * @return integer
     */
    public function getCdom()
    {
        return $this->cdom;
    }

    /**
     * Set directions
     *
     * @param string $directions
     *
     * @return MlsLeaseProperties
     */
    public function setDirections($directions)
    {
        $this->directions = $directions;

        return $this;
    }

    /**
     * Get directions
     *
     * @return string
     */
    public function getDirections()
    {
        return $this->directions;
    }

    /**
     * Set subdivision
     *
     * @param string $subdivision
     *
     * @return MlsLeaseProperties
     */
    public function setSubdivision($subdivision)
    {
        $this->subdivision = $subdivision;

        return $this;
    }

    /**
     * Get subdivision
     *
     * @return string
     */
    public function getSubdivision()
    {
        return $this->subdivision;
    }

    /**
     * Set compbuy
     *
     * @param string $compbuy
     *
     * @return MlsLeaseProperties
     */
    public function setCompbuy($compbuy)
    {
        $this->compbuy = $compbuy;

        return $this;
    }

    /**
     * Get compbuy
     *
     * @return string
     */
    public function getCompbuy()
    {
        return $this->compbuy;
    }

    /**
     * Set daysonmarket
     *
     * @param integer $daysonmarket
     *
     * @return MlsLeaseProperties
     */
    public function setDaysonmarket($daysonmarket)
    {
        $this->daysonmarket = $daysonmarket;

        return $this;
    }

    /**
     * Get daysonmarket
     *
     * @return integer
     */
    public function getDaysonmarket()
    {
        return $this->daysonmarket;
    }

    /**
     * Set bathshalf
     *
     * @param integer $bathshalf
     *
     * @return MlsLeaseProperties
     */
    public function setBathshalf($bathshalf)
    {
        $this->bathshalf = $bathshalf;

        return $this;
    }

    /**
     * Get bathshalf
     *
     * @return integer
     */
    public function getBathshalf()
    {
        return $this->bathshalf;
    }

    /**
     * Set beds
     *
     * @param integer $beds
     *
     * @return MlsLeaseProperties
     */
    public function setBeds($beds)
    {
        $this->beds = $beds;

        return $this;
    }

    /**
     * Get beds
     *
     * @return integer
     */
    public function getBeds()
    {
        return $this->beds;
    }

    /**
     * Set bathstotal
     *
     * @param string $bathstotal
     *
     * @return MlsLeaseProperties
     */
    public function setBathstotal($bathstotal)
    {
        $this->bathstotal = $bathstotal;

        return $this;
    }

    /**
     * Get bathstotal
     *
     * @return string
     */
    public function getBathstotal()
    {
        return $this->bathstotal;
    }

    /**
     * Set style
     *
     * @param string $style
     *
     * @return MlsLeaseProperties
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set acres
     *
     * @param string $acres
     *
     * @return MlsLeaseProperties
     */
    public function setAcres($acres)
    {
        $this->acres = $acres;

        return $this;
    }

    /**
     * Get acres
     *
     * @return string
     */
    public function getAcres()
    {
        return $this->acres;
    }

    /**
     * Set exterior
     *
     * @param string $exterior
     *
     * @return MlsLeaseProperties
     */
    public function setExterior($exterior)
    {
        $this->exterior = $exterior;

        return $this;
    }

    /**
     * Get exterior
     *
     * @return string
     */
    public function getExterior()
    {
        return $this->exterior;
    }

    /**
     * Set fireplacedesc
     *
     * @param string $fireplacedesc
     *
     * @return MlsLeaseProperties
     */
    public function setFireplacedesc($fireplacedesc)
    {
        $this->fireplacedesc = $fireplacedesc;

        return $this;
    }

    /**
     * Get fireplacedesc
     *
     * @return string
     */
    public function getFireplacedesc()
    {
        return $this->fireplacedesc;
    }

    /**
     * Set interior
     *
     * @param string $interior
     *
     * @return MlsLeaseProperties
     */
    public function setInterior($interior)
    {
        $this->interior = $interior;

        return $this;
    }

    /**
     * Get interior
     *
     * @return string
     */
    public function getInterior()
    {
        return $this->interior;
    }

    /**
     * Set occupancy
     *
     * @param string $occupancy
     *
     * @return MlsLeaseProperties
     */
    public function setOccupancy($occupancy)
    {
        $this->occupancy = $occupancy;

        return $this;
    }

    /**
     * Get occupancy
     *
     * @return string
     */
    public function getOccupancy()
    {
        return $this->occupancy;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return MlsLeaseProperties
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Set realremarks
     *
     * @param string $realremarks
     *
     * @return MlsLeaseProperties
     */
    public function setRealremarks($realremarks)
    {
        $this->realremarks = $realremarks;

        return $this;
    }

    /**
     * Get realremarks
     *
     * @return string
     */
    public function getRealremarks()
    {
        return $this->realremarks;
    }

    /**
     * Set showinstr
     *
     * @param string $showinstr
     *
     * @return MlsLeaseProperties
     */
    public function setShowinstr($showinstr)
    {
        $this->showinstr = $showinstr;

        return $this;
    }

    /**
     * Get showinstr
     *
     * @return string
     */
    public function getShowinstr()
    {
        return $this->showinstr;
    }

    /**
     * Set construction
     *
     * @param string $construction
     *
     * @return MlsLeaseProperties
     */
    public function setConstruction($construction)
    {
        $this->construction = $construction;

        return $this;
    }

    /**
     * Get construction
     *
     * @return string
     */
    public function getConstruction()
    {
        return $this->construction;
    }

    /**
     * Set hoa
     *
     * @param string $hoa
     *
     * @return MlsLeaseProperties
     */
    public function setHoa($hoa)
    {
        $this->hoa = $hoa;

        return $this;
    }

    /**
     * Get hoa
     *
     * @return string
     */
    public function getHoa()
    {
        return $this->hoa;
    }

    /**
     * Set stories
     *
     * @param integer $stories
     *
     * @return MlsLeaseProperties
     */
    public function setStories($stories)
    {
        $this->stories = $stories;

        return $this;
    }

    /**
     * Get stories
     *
     * @return integer
     */
    public function getStories()
    {
        return $this->stories;
    }

    /**
     * Set unitnum
     *
     * @param string $unitnum
     *
     * @return MlsLeaseProperties
     */
    public function setUnitnum($unitnum)
    {
        $this->unitnum = $unitnum;

        return $this;
    }

    /**
     * Get unitnum
     *
     * @return string
     */
    public function getUnitnum()
    {
        return $this->unitnum;
    }

    /**
     * Set taxid
     *
     * @param string $taxid
     *
     * @return MlsLeaseProperties
     */
    public function setTaxid($taxid)
    {
        $this->taxid = $taxid;

        return $this;
    }

    /**
     * Get taxid
     *
     * @return string
     */
    public function getTaxid()
    {
        return $this->taxid;
    }

    /**
     * Set lotnum
     *
     * @param string $lotnum
     *
     * @return MlsLeaseProperties
     */
    public function setLotnum($lotnum)
    {
        $this->lotnum = $lotnum;

        return $this;
    }

    /**
     * Get lotnum
     *
     * @return string
     */
    public function getLotnum()
    {
        return $this->lotnum;
    }

    /**
     * Set lotsize
     *
     * @param string $lotsize
     *
     * @return MlsLeaseProperties
     */
    public function setLotsize($lotsize)
    {
        $this->lotsize = $lotsize;

        return $this;
    }

    /**
     * Get lotsize
     *
     * @return string
     */
    public function getLotsize()
    {
        return $this->lotsize;
    }

    /**
     * Set lotdim
     *
     * @param string $lotdim
     *
     * @return MlsLeaseProperties
     */
    public function setLotdim($lotdim)
    {
        $this->lotdim = $lotdim;

        return $this;
    }

    /**
     * Get lotdim
     *
     * @return string
     */
    public function getLotdim()
    {
        return $this->lotdim;
    }

    /**
     * Set bathsfull
     *
     * @param integer $bathsfull
     *
     * @return MlsLeaseProperties
     */
    public function setBathsfull($bathsfull)
    {
        $this->bathsfull = $bathsfull;

        return $this;
    }

    /**
     * Get bathsfull
     *
     * @return integer
     */
    public function getBathsfull()
    {
        return $this->bathsfull;
    }

    /**
     * Set ownerName
     *
     * @param string $ownerName
     *
     * @return MlsLeaseProperties
     */
    public function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;

        return $this;
    }

    /**
     * Get ownerName
     *
     * @return string
     */
    public function getOwnerName()
    {
        return $this->ownerName;
    }

    /**
     * Set agentsell
     *
     * @param string $agentsell
     *
     * @return MlsLeaseProperties
     */
    public function setAgentsell($agentsell)
    {
        $this->agentsell = $agentsell;

        return $this;
    }

    /**
     * Get agentsell
     *
     * @return string
     */
    public function getAgentsell()
    {
        return $this->agentsell;
    }

    /**
     * Set agentsellAgentname
     *
     * @param string $agentsellAgentname
     *
     * @return MlsLeaseProperties
     */
    public function setAgentsellAgentname($agentsellAgentname)
    {
        $this->agentsellAgentname = $agentsellAgentname;

        return $this;
    }

    /**
     * Get agentsellAgentname
     *
     * @return string
     */
    public function getAgentsellAgentname()
    {
        return $this->agentsellAgentname;
    }

    /**
     * Set sellerType
     *
     * @param string $sellerType
     *
     * @return MlsLeaseProperties
     */
    public function setSellerType($sellerType)
    {
        $this->sellerType = $sellerType;

        return $this;
    }

    /**
     * Get sellerType
     *
     * @return string
     */
    public function getSellerType()
    {
        return $this->sellerType;
    }

    /**
     * Set streetdirPrefix
     *
     * @param string $streetdirPrefix
     *
     * @return MlsLeaseProperties
     */
    public function setStreetdirPrefix($streetdirPrefix)
    {
        $this->streetdirPrefix = $streetdirPrefix;

        return $this;
    }

    /**
     * Get streetdirPrefix
     *
     * @return string
     */
    public function getStreetdirPrefix()
    {
        return $this->streetdirPrefix;
    }

    /**
     * Set streetdirSuffix
     *
     * @param string $streetdirSuffix
     *
     * @return MlsLeaseProperties
     */
    public function setStreetdirSuffix($streetdirSuffix)
    {
        $this->streetdirSuffix = $streetdirSuffix;

        return $this;
    }

    /**
     * Get streetdirSuffix
     *
     * @return string
     */
    public function getStreetdirSuffix()
    {
        return $this->streetdirSuffix;
    }
}
