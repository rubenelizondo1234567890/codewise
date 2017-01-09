<?php

namespace RetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MlsLeaseProperties
 *
 * @ORM\Table(name="mls_lease_properties", uniqueConstraints={@ORM\UniqueConstraint(name="mlsnum", columns={"mlsnum", "market_id"})}, indexes={@ORM\Index(name="market_id", columns={"market_id"}), @ORM\Index(name="latitude", columns={"latitude"})})
 * @ORM\Entity
 */
class MlsLeaseProperties
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
     * @ORM\Column(name="market_id", type="integer", nullable=false, options={"unsigned":true})
     */
    private $marketId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_updated", type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_alv_calculated", type="datetime", nullable=true)
     */
    private $dateAlvCalculated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="needs_alv_calculation", type="boolean", nullable=false, options={"unsigned":true,"default":"0"})
     */
    private $needsAlvCalculation;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="decimal", precision=20, scale=12, nullable=true, options={"comment":"Latitude"})
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="decimal", precision=20, scale=12, nullable=true, options={"comment":"Longitude"})
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_id", type="string", length=20, nullable=false, options={"fixed":false})
     */
    private $photoId;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_file", type="string", length=255, nullable=true, options={"fixed":false})
     */
    private $photoFile;

    /**
     * @var boolean
     *
     * @ORM\Column(name="photo_count", type="boolean", nullable=false, options={"unsigned":true,"comment":"count of downloaded photos","default":"0"})
     */
    private $photoCount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="photo_updated", type="datetime", nullable=true)
     */
    private $photoUpdated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="photo_modified", type="datetime", nullable=true)
     */
    private $photoModified;

    /**
     * @var string
     *
     * @ORM\Column(name="mlsnum", type="string", length=12, nullable=true, options={"fixed":false,"comment":"MLS #"})
     */
    private $mlsnum;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=true, options={"comment":"Modified"})
     */
    private $modified;

    /**
     * @var string
     *
     * @ORM\Column(name="liststatus", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Status"})
     */
    private $liststatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="salesprice", type="integer", nullable=true, options={"unsigned":false,"comment":"Sales Price"})
     */
    private $salesprice;

    /**
     * @var integer
     *
     * @ORM\Column(name="listprice", type="integer", nullable=true, options={"unsigned":false,"comment":"List Price"})
     */
    private $listprice;

    /**
     * @var integer
     *
     * @ORM\Column(name="listpriceorig", type="integer", nullable=true, options={"unsigned":false,"comment":"Original List Price"})
     */
    private $listpriceorig;

    /**
     * @var integer
     *
     * @ORM\Column(name="listpricelow", type="integer", nullable=true, options={"unsigned":false,"comment":"Low Price"})
     */
    private $listpricelow;

    /**
     * @var string
     *
     * @ORM\Column(name="sqftprice", type="decimal", precision=15, scale=2, nullable=true, options={"comment":"List$/SqFt"})
     */
    private $sqftprice;

    /**
     * @var string
     *
     * @ORM\Column(name="sqftpricesold", type="decimal", precision=15, scale=2, nullable=true, options={"comment":"Price per SqFt (Sale)"})
     */
    private $sqftpricesold;

    /**
     * @var integer
     *
     * @ORM\Column(name="sqfttotal", type="integer", nullable=true, options={"unsigned":false,"comment":"SqFt"})
     */
    private $sqfttotal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="statuschangedate", type="datetime", nullable=true, options={"comment":"Status Change Date"})
     */
    private $statuschangedate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="listdate", type="datetime", nullable=true, options={"comment":"Listing Date"})
     */
    private $listdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pendingdate", type="datetime", nullable=true, options={"comment":"Pending Date"})
     */
    private $pendingdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="closeddate", type="datetime", nullable=true, options={"comment":"Sold Date"})
     */
    private $closeddate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiredateoption", type="datetime", nullable=true, options={"comment":"Option Expiration Date"})
     */
    private $expiredateoption;

    /**
     * @var string
     *
     * @ORM\Column(name="area", type="string", length=255, nullable=true, options={"fixed":false,"comment":"Area"})
     */
    private $area;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=2, nullable=true, options={"fixed":false,"comment":"State"})
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="county", type="string", length=32, nullable=true, options={"fixed":false,"comment":"County"})
     */
    private $county;

    /**
     * @var string
     *
     * @ORM\Column(name="mapbook", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Map Book"})
     */
    private $mapbook;

    /**
     * @var string
     *
     * @ORM\Column(name="mappage", type="string", length=5, nullable=true, options={"fixed":false,"comment":"Map Page"})
     */
    private $mappage;

    /**
     * @var string
     *
     * @ORM\Column(name="mapcoord", type="string", length=5, nullable=true, options={"fixed":false,"comment":"Map Coord"})
     */
    private $mapcoord;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=25, nullable=true, options={"fixed":false,"comment":"Zip Code"})
     */
    private $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=32, nullable=true, options={"fixed":false,"comment":"City"})
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="streettype", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Street Type"})
     */
    private $streettype;

    /**
     * @var string
     *
     * @ORM\Column(name="streetname", type="string", length=25, nullable=true, options={"fixed":false,"comment":"Street Name"})
     */
    private $streetname;

    /**
     * @var integer
     *
     * @ORM\Column(name="streetnum", type="integer", nullable=true, options={"unsigned":false,"comment":"Street/Box Number"})
     */
    private $streetnum;

    /**
     * @var string
     *
     * @ORM\Column(name="streetnumdisplay", type="string", length=25, nullable=true, options={"fixed":false,"comment":"Street/Box Number"})
     */
    private $streetnumdisplay;

    /**
     * @var string
     *
     * @ORM\Column(name="officelist", type="string", length=25, nullable=true, options={"fixed":false,"comment":"Listing Office Code"})
     */
    private $officelist;

    /**
     * @var string
     *
     * @ORM\Column(name="officelist_officenam1", type="string", length=100, nullable=true, options={"fixed":false,"comment":"Listing Office Name"})
     */
    private $officelistOfficenam1;

    /**
     * @var string
     *
     * @ORM\Column(name="officelist_address", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Listing Office Address 1"})
     */
    private $officelistAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="officelist_address2", type="string", length=30, nullable=true, options={"fixed":false,"comment":"Listing Office Address 2"})
     */
    private $officelistAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="officelist_phon1", type="string", length=25, nullable=true, options={"fixed":false,"comment":"Listing Office Phone"})
     */
    private $officelistPhon1;

    /**
     * @var string
     *
     * @ORM\Column(name="officelist_fax", type="string", length=25, nullable=true, options={"fixed":false,"comment":"Listing Office Fax"})
     */
    private $officelistFax;

    /**
     * @var string
     *
     * @ORM\Column(name="officelist_city", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Listing Office City"})
     */
    private $officelistCity;

    /**
     * @var string
     *
     * @ORM\Column(name="officelist_zip", type="string", length=12, nullable=true, options={"fixed":false,"comment":"Listing Office Zip"})
     */
    private $officelistZip;

    /**
     * @var string
     *
     * @ORM\Column(name="officelist_state", type="string", length=2, nullable=true, options={"fixed":false,"comment":"Listing Office State"})
     */
    private $officelistState;

    /**
     * @var string
     *
     * @ORM\Column(name="officelist_web", type="string", length=100, nullable=true, options={"fixed":false,"comment":"Listing Office Web"})
     */
    private $officelistWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="officesell_officenam2", type="string", length=100, nullable=true, options={"fixed":false,"comment":"Selling Office Name"})
     */
    private $officesellOfficenam2;

    /**
     * @var string
     *
     * @ORM\Column(name="officesell", type="string", length=20, nullable=true, options={"fixed":false,"comment":"Selling Office ID"})
     */
    private $officesell;

    /**
     * @var string
     *
     * @ORM\Column(name="officesell_phon2", type="string", length=25, nullable=true, options={"fixed":false,"comment":"Selling Office Phone"})
     */
    private $officesellPhon2;

    /**
     * @var string
     *
     * @ORM\Column(name="housingtype", type="text", length=16777215, nullable=true, options={"fixed":false,"comment":"Housing Type"})
     */
    private $housingtype;

    /**
     * @var string
     *
     * @ORM\Column(name="propsubtype", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Property Type"})
     */
    private $propsubtype;

    /**
     * @var string
     *
     * @ORM\Column(name="condoyn", type="string", length=1, nullable=true, options={"fixed":false,"comment":"if condoyn=Y it is a condo, if condoyn=N it is a townhome"})
     */
    private $condoyn;

    /**
     * @var integer
     *
     * @ORM\Column(name="yearbuilt", type="integer", nullable=true, options={"unsigned":false,"comment":"Year Built"})
     */
    private $yearbuilt;

    /**
     * @var string
     *
     * @ORM\Column(name="liststatusflag", type="string", length=50, nullable=true, options={"fixed":false,"comment":"ListStatusFlag"})
     */
    private $liststatusflag;

    /**
     * @var string
     *
     * @ORM\Column(name="agentlist", type="string", length=20, nullable=true, options={"fixed":false,"comment":"Listing Agent ID"})
     */
    private $agentlist;

    /**
     * @var string
     *
     * @ORM\Column(name="agentlist_fullname", type="string", length=150, nullable=true, options={"fixed":false,"comment":"Listing Agent Name"})
     */
    private $agentlistFullname;

    /**
     * @var string
     *
     * @ORM\Column(name="agentlist_firstname", type="string", length=20, nullable=true, options={"fixed":false,"comment":"Listing Agent First Name"})
     */
    private $agentlistFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="agentlist_lastname", type="string", length=20, nullable=true, options={"fixed":false,"comment":"Listing Agent Last Name"})
     */
    private $agentlistLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="agentlist_fax", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Listing Agent Fax"})
     */
    private $agentlistFax;

    /**
     * @var string
     *
     * @ORM\Column(name="agentlist_phone", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Listing Agent Phone"})
     */
    private $agentlistPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="agentlist_mobilenum1", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Listing Agent Mobile"})
     */
    private $agentlistMobilenum1;

    /**
     * @var string
     *
     * @ORM\Column(name="agentlist_email", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Listing Agent Email"})
     */
    private $agentlistEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="agentlist_voicmail1", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Listing Agent Other"})
     */
    private $agentlistVoicmail1;

    /**
     * @var string
     *
     * @ORM\Column(name="agentlist_pagernum1", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Listing Agent Pager"})
     */
    private $agentlistPagernum1;

    /**
     * @var string
     *
     * @ORM\Column(name="agentlist_web", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Listing Agent Web"})
     */
    private $agentlistWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="heatsystem", type="text", length=16777215, nullable=true, options={"fixed":false,"comment":"Heating/Cooling"})
     */
    private $heatsystem;

    /**
     * @var integer
     *
     * @ORM\Column(name="assocfee", type="integer", nullable=true, options={"unsigned":false,"comment":"HOA Dues"})
     */
    private $assocfee;

    /**
     * @var string
     *
     * @ORM\Column(name="compsell", type="string", length=10, nullable=true, options={"fixed":false,"comment":"SubAgency Commission"})
     */
    private $compsell;

    /**
     * @var string
     *
     * @ORM\Column(name="assocfeepaid", type="string", length=50, nullable=true, options={"fixed":false,"comment":"HOA Billing Freq"})
     */
    private $assocfeepaid;

    /**
     * @var string
     *
     * @ORM\Column(name="block", type="string", length=7, nullable=true, options={"fixed":false,"comment":"Block"})
     */
    private $block;

    /**
     * @var integer
     *
     * @ORM\Column(name="cdom", type="integer", nullable=true, options={"unsigned":false,"comment":"CDOM"})
     */
    private $cdom;

    /**
     * @var string
     *
     * @ORM\Column(name="directions", type="string", length=150, nullable=true, options={"fixed":false,"comment":"Directions"})
     */
    private $directions;

    /**
     * @var string
     *
     * @ORM\Column(name="subdivision", type="string", length=40, nullable=true, options={"fixed":false,"comment":"Subdivision"})
     */
    private $subdivision;

    /**
     * @var string
     *
     * @ORM\Column(name="compbuy", type="string", length=10, nullable=true, options={"fixed":false,"comment":"Buyers Agency Commission"})
     */
    private $compbuy;

    /**
     * @var integer
     *
     * @ORM\Column(name="daysonmarket", type="integer", nullable=true, options={"unsigned":false,"comment":"Days On Market"})
     */
    private $daysonmarket;

    /**
     * @var integer
     *
     * @ORM\Column(name="bathshalf", type="integer", nullable=true, options={"unsigned":false,"comment":"# Half Baths"})
     */
    private $bathshalf;

    /**
     * @var integer
     *
     * @ORM\Column(name="beds", type="integer", nullable=true, options={"unsigned":false,"comment":"# Bedrooms"})
     */
    private $beds;

    /**
     * @var string
     *
     * @ORM\Column(name="bathstotal", type="decimal", precision=4, scale=1, nullable=true, options={"comment":"Total Baths"})
     */
    private $bathstotal;

    /**
     * @var string
     *
     * @ORM\Column(name="style", type="text", length=16777215, nullable=true, options={"fixed":false,"comment":"Style of House"})
     */
    private $style;

    /**
     * @var string
     *
     * @ORM\Column(name="acres", type="decimal", precision=10, scale=3, nullable=true, options={"comment":"Acres"})
     */
    private $acres;

    /**
     * @var string
     *
     * @ORM\Column(name="exterior", type="text", length=16777215, nullable=true, options={"fixed":false,"comment":"Exterior Features"})
     */
    private $exterior;

    /**
     * @var string
     *
     * @ORM\Column(name="fireplacedesc", type="text", length=16777215, nullable=true, options={"fixed":false,"comment":"Fireplace Type"})
     */
    private $fireplacedesc;

    /**
     * @var string
     *
     * @ORM\Column(name="interior", type="text", length=16777215, nullable=true, options={"fixed":false,"comment":"Interior Features"})
     */
    private $interior;

    /**
     * @var string
     *
     * @ORM\Column(name="occupancy", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Occupancy"})
     */
    private $occupancy;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="text", length=16777215, nullable=true, options={"fixed":false,"comment":"Property Description"})
     */
    private $remarks;

    /**
     * @var string
     *
     * @ORM\Column(name="realremarks", type="text", length=16777215, nullable=true, options={"fixed":false,"comment":"Private Remarks"})
     */
    private $realremarks;

    /**
     * @var string
     *
     * @ORM\Column(name="showinstr", type="string", length=255, nullable=true, options={"fixed":false,"comment":"Show Instr"})
     */
    private $showinstr;

    /**
     * @var string
     *
     * @ORM\Column(name="construction", type="text", length=16777215, nullable=true, options={"fixed":false,"comment":"Construction"})
     */
    private $construction;

    /**
     * @var string
     *
     * @ORM\Column(name="hoa", type="string", length=50, nullable=true, options={"fixed":false,"comment":"HOA"})
     */
    private $hoa;

    /**
     * @var integer
     *
     * @ORM\Column(name="stories", type="integer", nullable=true, options={"unsigned":false,"comment":"# of Stories"})
     */
    private $stories;

    /**
     * @var string
     *
     * @ORM\Column(name="unitnum", type="string", length=6, nullable=true, options={"fixed":false,"comment":"Unit #"})
     */
    private $unitnum;

    /**
     * @var string
     *
     * @ORM\Column(name="taxid", type="string", length=30, nullable=true, options={"fixed":false,"comment":"Parcel ID"})
     */
    private $taxid;

    /**
     * @var string
     *
     * @ORM\Column(name="lotnum", type="string", length=60, nullable=true, options={"fixed":false,"comment":"Lot"})
     */
    private $lotnum;

    /**
     * @var string
     *
     * @ORM\Column(name="lotsize", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Lot Size/Acreage"})
     */
    private $lotsize;

    /**
     * @var string
     *
     * @ORM\Column(name="lotdim", type="string", length=25, nullable=true, options={"fixed":false,"comment":"Lot Dimensions"})
     */
    private $lotdim;

    /**
     * @var integer
     *
     * @ORM\Column(name="bathsfull", type="integer", nullable=true, options={"unsigned":false,"comment":"# Full Baths"})
     */
    private $bathsfull;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_name", type="string", length=30, nullable=true, options={"fixed":false,"comment":"Owner Name"})
     */
    private $ownerName;

    /**
     * @var string
     *
     * @ORM\Column(name="agentsell", type="string", length=20, nullable=true, options={"fixed":false,"comment":"Selling Agent ID"})
     */
    private $agentsell;

    /**
     * @var string
     *
     * @ORM\Column(name="agentsell_agentname", type="string", length=150, nullable=true, options={"fixed":false,"comment":"Selling Agent Name"})
     */
    private $agentsellAgentname;

    /**
     * @var string
     *
     * @ORM\Column(name="seller_type", type="string", length=50, nullable=true, options={"fixed":false,"comment":"Seller Type"})
     */
    private $sellerType;

    /**
     * @var string
     *
     * @ORM\Column(name="streetdir_prefix", type="string", length=2, nullable=true, options={"fixed":false,"comment":"Street Direction Prefix"})
     */
    private $streetdirPrefix;

    /**
     * @var string
     *
     * @ORM\Column(name="streetdir_suffix", type="string", length=2, nullable=true, options={"fixed":false,"comment":"Street Dir Suffix"})
     */
    private $streetdirSuffix;



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
