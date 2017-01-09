<?php

namespace RetsBundle\Adapter\Mapper;

use RetsBundle\Adapter\mlsMapper;
use RetsBundle\Adapter\Normalizer\MlsNormalizer;

/**
 * philadelphiaMlsMapper
 * Maps MLS Raw data to MLS Properties for THIS RETS Server
 */
class philadelphiaMlsMapper extends mlsMapper
{
    /* @var marketId */
    protected $marketId;


    public function __construct($marketId)
    {
        $this->marketId = $marketId;
    }

    /**
     * mapToMlsProperties
     * Decodes json row and sets MlsProperties
     * @param $mlsFetchedRow json object
     */
    function mapToMlsProperties($mlsFetchedRow)
    {
    	$obj = json_decode($mlsFetchedRow);

    	foreach ($obj as $key => $value) {
    		$this->setMappedProperties($key, $value);
    	}  	

    }

    /**
     * setMappedProperties
     * Maps raw fields from THIS RETS Server to its corresponding MlsProperties property
     * @param $key name of the raw field
     * @param $value value of raw field
     */
    function setMappedProperties($key, $value)
    {
        /*
         * IMPORTANT: We need to verify and ensure this raw fields are correctly mapped to its corresponding MlsProperties property
         *
         */

        $this->setMarketId(MlsNormalizer::normalizeType($this->marketId, 'Integer'));// Currently the markets table has 8 rows each to different RETS Servers -- TODO: update this table with new market

        //TODO: check if thess needs to be set to false initially
        $this->setNeedsArvCalculation(MlsNormalizer::normalizeType('0', 'Boolean', 1, false));
        $this->setNeedsAlvCalculation(MlsNormalizer::normalizeType('0', 'Boolean', 1, false));

        // Assuming these properties are using the timestamp when created
        $this->setDateCreated(MlsNormalizer::normalizeType('now', 'DateTime'));
        $this->setDateUpdated(MlsNormalizer::normalizeType('now', 'DateTime'));

        // TODO: check the impact on setting these dates to current time stamp
        $this->setPendingdate(MlsNormalizer::normalizeType('now', 'DateTime'));
        $this->setCloseddate(MlsNormalizer::normalizeType('now', 'DateTime'));
        $this->setExpiredateoption(MlsNormalizer::normalizeType('now', 'DateTime'));

    	switch ($key) {
    		case 'City':
    			$this->setCity(MlsNormalizer::normalizeType($value, 'String', 35));
    			break;
    		case 'Latitude':
                $this->setLatitude(MlsNormalizer::normalizeType($value, 'Decimal', 20));
                break;
            case 'Longitude':
                $this->setLongitude(MlsNormalizer::normalizeType($value, 'Decimal', 20));
                break;
            case 'Matrix_Unique_ID':
                $this->setPhotoId(MlsNormalizer::normalizeType($value, 'String', 20, false));
                break;            
            case 'PhotoCount':
                $this->setPhotoCount(MlsNormalizer::normalizeType($value, 'Boolean', 1, false));
                break;
            case 'PhotoModificationTimestamp':
                $this->setPhotoModified(MlsNormalizer::normalizeType($value, 'DateTime'));
                break;
            case 'MLSNumber':
                $this->setMlsnum(MlsNormalizer::normalizeType($value, 'String', 12));
                break;
            case 'MatrixModifiedDT':
                $this->setModified(MlsNormalizer::normalizeType($value, 'DateTime'));
                break;
            case 'Status':
                // TODO: verify different status for this particular market are the same as used in the MLS Properties table 
                $this->setListstatus(MlsNormalizer::normalizeType($value, 'String', 50));
                break;
            case 'ListPrice':
                $this->setListprice(MlsNormalizer::normalizeType($value, 'Integer'));
                break;
            case 'OriginalListPrice':
                $this->setListpriceorig(MlsNormalizer::normalizeType($value, 'Integer'));
                break;
            case 'SqftTotal':
                $this->setSqfttotal(MlsNormalizer::normalizeType($value, 'Integer'));
                break;
            case 'StatusChangeTimestamp':
                $this->setStatuschangedate(MlsNormalizer::normalizeType($value, 'DateTime'));
                break;
            case 'OriginalListDate':
                $this->setListdate(MlsNormalizer::normalizeType($value, 'DateTime'));
                break;
            case 'Neighborhood':
                $this->setArea(MlsNormalizer::normalizeType($value, 'String', 255));
                break;
            case 'StateOrProvince':
                $this->setState(MlsNormalizer::normalizeType($value, 'String', 2));
                break;
            case 'CountyOrParish':
                $this->setCounty(MlsNormalizer::normalizeType($value, 'String', 32));
                break;
            case 'PostalCode':
                $this->setZipcode(MlsNormalizer::normalizeType($value, 'String', 5));
                break;
            case 'City':
                $this->setCity(MlsNormalizer::normalizeType($value, 'String', 35));
                break;
            case 'StreetSuffix':
                $this->setStreettype(MlsNormalizer::normalizeType($value, 'String', 15));
                break;
            case 'StreetName':
                $this->setStreetname(MlsNormalizer::normalizeType($value, 'String', 25));
                break;
            case 'StreetNumber':
                $this->setStreetnum(MlsNormalizer::normalizeType($value, 'String', 10));
                break;
            case 'StreetNumberSearchable':
                $this->setStreetnumdisplay(MlsNormalizer::normalizeType($value, 'String', 15));
                break;
            case 'ListOfficeMLSID':
                $this->setOfficelist(MlsNormalizer::normalizeType($value, 'String', 25));
                break;
            case 'ListOfficeName':
                $this->setOfficelistOfficenam1(MlsNormalizer::normalizeType($value, 'String', 100));
                break;
            case 'ListOfficePhone':
                $this->setOfficelistPhon1(MlsNormalizer::normalizeType($value, 'String', 25));
                break;
            case 'SellingOfficeMLSID':
                $this->setOfficesell(MlsNormalizer::normalizeType($value, 'String', 20));
                break;
            case 'SellingOfficePhone':
                $this->setOfficesellPhon2(MlsNormalizer::normalizeType($value, 'String', 25));
                break;
            case 'PropertyType':
                $this->setHousingtype(MlsNormalizer::normalizeType($value, 'Text', 16777215));
                break;
            case 'PropertySubType':
                $this->setPropsubtype(MlsNormalizer::normalizeType($value, 'String', 50));
                break;
            case 'YearBuilt':
                $this->setYearbuilt(MlsNormalizer::normalizeType($value, 'Integer'));
                break;
            case 'ListAgentMLSID':
                $this->setAgentlist(MlsNormalizer::normalizeType($value, 'String', 20));
                break;
            case 'ListAgentFullName':
                $this->setAgentlistFullname(MlsNormalizer::normalizeType($value, 'String', 150));
                $parts = explode(" ", $value);
                $this->setAgentlistFirstname(MlsNormalizer::normalizeType(array_shift($parts), 'String', 20));// Do we need to get the first name from the full name?
                $this->setAgentlistLastname(MlsNormalizer::normalizeType(array_pop($parts), 'String', 20));// Do we need to get the last name from the full name?
                break;
            case 'ListAgentDirectWorkPhone':
                $this->setAgentlistPhone(MlsNormalizer::normalizeType($value, 'String', 50));
                break;
            case 'ListAgentEmail':
                $this->setAgentlistEmail(MlsNormalizer::normalizeType($value, 'String', 50));
                break;
            case 'Heating':
                $this->setHeatsystem(MlsNormalizer::normalizeType($value, 'Text', 16777215));
                break;
            case 'AssociationFeePrimary':
                $this->setAssocfee(MlsNormalizer::normalizeType($value, 'Integer'));
                break;
            case 'AssociationFeeFrequencyPrimary':
                $this->setAssocfeepaid(MlsNormalizer::normalizeType($value, 'String', 50));
                break;
            case 'CDOM':
                $this->setCdom(MlsNormalizer::normalizeType($value, 'Integer'));
                break;
            case 'Directions':
                $this->setDirections(MlsNormalizer::normalizeType($value, 'String', 150));
                break;
            case 'BedsTotal':
                $this->setBeds(MlsNormalizer::normalizeType($value, 'Integer'));
                break;
            case 'BathsTotal':
                $this->setBathstotal(MlsNormalizer::normalizeType($value, 'Decimal', 4));
                break;
            case 'ArchitecturalStyle':
                $this->setStyle(MlsNormalizer::normalizeType($value, 'Text', 16777215));
                break;
            case 'LotSizeAcres':
                $this->setAcres(MlsNormalizer::normalizeType($value, 'Decimal', 10));
                break;
            case 'ExteriorFeatures':
                $this->setExterior(MlsNormalizer::normalizeType($value, 'Text', 16777215));
                break;
            case 'FireplaceFeatures':
                $this->setFireplacedesc(MlsNormalizer::normalizeType($value, 'Text', 16777215));
                break;
            case 'GarageSpacesCount':
                $this->setGarage(MlsNormalizer::normalizeType($value, 'Text', 255));
                break;
            case 'InteriorFeatures':
                $this->setInterior(MlsNormalizer::normalizeType($value, 'Text', 16777215));
                break;
            case 'PublicRemarks':
                $this->setRemarks(MlsNormalizer::normalizeType($value, 'Text', 16777215));
                break;
            case 'PrivateRemarks':
                $this->setRealremarks(MlsNormalizer::normalizeType($value, 'Text', 16777215));
                break;
            case 'ShowingInstructions':
                $this->setShowinstr(MlsNormalizer::normalizeType($value, 'String', 255));
                break;
            case 'ConstructionDetails':
                $this->setConstruction(MlsNormalizer::normalizeType($value, 'Text', 16777215));
                break;
            case 'HasHOAYN':
                $this->setHoa(MlsNormalizer::normalizeType($value, 'String', 50));
                break;
            case 'UnitNumberOfFloors':
                $this->setStories(MlsNormalizer::normalizeType($value, 'Integer'));
                break;
            case 'UnitNumber':
                $this->setUnitnum(MlsNormalizer::normalizeType($value, 'String', 6));
                break;
            case 'LotSizeSqFt':
                $this->setLotsize(MlsNormalizer::normalizeType($value, 'String', 50));
                break;
            case 'LotSizeDimensions':
                $this->setLotdim(MlsNormalizer::normalizeType($value, 'String', 25));
                break;
            case 'SellingAgentMLSID':
                $this->setAgentsell(MlsNormalizer::normalizeType($value, 'String', 20));
                break;
            case 'SellingAgentFullName':
                $this->setAgentsellAgentname(MlsNormalizer::normalizeType($value, 'String', 150));
                break;
            case 'SellerType':
                $this->setSellerType(MlsNormalizer::normalizeType($value, 'String', 125));
                break;
            case 'StreetDirPrefix':
                $this->setStreetdirPrefix(MlsNormalizer::normalizeType($value, 'String', 2));
                break;
            case 'StreetSuffix':
                $this->setStreetdirSuffix(MlsNormalizer::normalizeType($value, 'String', 2));
                break;
            case 'Zoning':
                $this->setZoningcode(MlsNormalizer::normalizeType($value, 'String', 100));
                break;
            case 'SchoolDistrict':
                $this->setSchooldistrict(MlsNormalizer::normalizeType($value, 'String', 75));
                break;
    		default:
    			# code...
    			break;
    	}

    }

}
