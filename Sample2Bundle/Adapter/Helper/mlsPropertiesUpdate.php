<?php

namespace RetsBundle\Adapter\Helper;


use RetsBundle\Entity\MlsProperties;

/**
 * mlsPropertiesUpdate
 * Helps on preparing MLS Properties updating required fields
 */
class mlsPropertiesUpdate
{
	/**
     * mlsPropertiesMapUpdate
     * Prepare for updating Mls properties
     * @param object $mlsProperties
     * @param object $mapperObj
     */
	public function mlsPropertiesMapUpdate(MlsProperties $mlsProperty, $mapperObj)
	{
		// Update Mls Property

        // No need to update this
        //$mlsProperty->setMarketId($mapperObj->getMarketId());

        // dont need to update date created
        //$mlsProperty->setDateCreated($mapperObj->getDateCreated());

        $mlsProperty->setDateUpdated($mapperObj->getDateUpdated());

        // TODO: check this
        //$mlsProperty->setDateArvCalculated($mapperObj->getDateArvCalculated());

        $mlsProperty->setNeedsArvCalculation($mapperObj->getNeedsArvCalculation());
        $mlsProperty->setArv($mapperObj->getArv());

        // TODO: check this
        //$mlsProperty->setDateAlvCalculated($mapperObj->getDateAlvCalculated());

        $mlsProperty->setNeedsAlvCalculation($mapperObj->getNeedsAlvCalculation());
        $mlsProperty->setAlv($mapperObj->getAlv());
        $mlsProperty->setEquity($mapperObj->getEquity());
        $mlsProperty->setComparedListings($mapperObj->getComparedListings());
        $mlsProperty->setComps($mapperObj->getComps());
        $mlsProperty->setComparedLeaseListings($mapperObj->getComparedLeaseListings());
        $mlsProperty->setCompsInSubdivision($mapperObj->getCompsInSubdivision());
        $mlsProperty->setLatitude($mapperObj->getLatitude());
        $mlsProperty->setLongitude($mapperObj->getLongitude());

        //TODO: Investigate how to get Photo Id and Photo file url for each mls mlsProperty
        $mlsProperty->setPhotoId(($mapperObj->getPhotoId())? $mapperObj->getPhotoId() : 'none');

        $mlsProperty->setPhotoFile($mapperObj->getPhotoFile());
        $mlsProperty->setPhotoCount(($mapperObj->getPhotoCount())? $mapperObj->getPhotoCount() : 0);
        $mlsProperty->setPhotoUpdated($mapperObj->getPhotoUpdated());
        $mlsProperty->setPhotoModified($mapperObj->getPhotoModified());

        // No need to update this
        //$mlsProperty->setMlsnum($mapperObj->getMlsnum());
        $mlsProperty->setModified($mapperObj->getModified());
        $mlsProperty->setListstatus($mapperObj->getListstatus());
        $mlsProperty->setSalesprice($mapperObj->getSalesprice());
        $mlsProperty->setListprice($mapperObj->getListprice());
        $mlsProperty->setListpriceorig($mapperObj->getListpriceorig());
        $mlsProperty->setListpricelow($mapperObj->getListpricelow());
        $mlsProperty->setSqftprice($mapperObj->getSqftprice());
        $mlsProperty->setSqftpricesold($mapperObj->getSqftpricesold());
        $mlsProperty->setSqfttotal($mapperObj->getSqfttotal());
        $mlsProperty->setStatuschangedate($mapperObj->getStatuschangedate());
        $mlsProperty->setListdate($mapperObj->getListdate());

        // TODO: check this
        //$mlsProperty->setPendingdate($mapperObj->getPendingdate());
        //$mlsProperty->setCloseddate($mapperObj->getCloseddate());
        //$mlsProperty->setExpiredateoption($mapperObj->getExpiredateoption());

        $mlsProperty->setArea($mapperObj->getArea());
        $mlsProperty->setState($mapperObj->getState());
        $mlsProperty->setCounty($mapperObj->getCounty());
        $mlsProperty->setMapbook($mapperObj->getMapbook());
        $mlsProperty->setMappage($mapperObj->getMappage());
        $mlsProperty->setMapcoord($mapperObj->getMapcoord());
        $mlsProperty->setZipcode($mapperObj->getZipcode());
        $mlsProperty->setCity($mapperObj->getCity());
        $mlsProperty->setStreettype($mapperObj->getStreettype());
        $mlsProperty->setStreetname($mapperObj->getStreetname());
        $mlsProperty->setStreetnum($mapperObj->getStreetnum());
        $mlsProperty->setStreetnumdisplay($mapperObj->getStreetnumdisplay());
        $mlsProperty->setOfficelist($mapperObj->getOfficelist());
        $mlsProperty->setOfficelistOfficenam1($mapperObj->getOfficelistOfficenam1());
        $mlsProperty->setOfficelistAddress($mapperObj->getOfficelistAddress());
        $mlsProperty->setOfficelistAddress2($mapperObj->getOfficelistAddress2());
        $mlsProperty->setOfficelistPhon1($mapperObj->getOfficelistPhon1());
        $mlsProperty->setOfficelistFax($mapperObj->getOfficelistFax());
        $mlsProperty->setOfficelistCity($mapperObj->getOfficelistCity());
        $mlsProperty->setOfficelistZip($mapperObj->getOfficelistZip());
        $mlsProperty->setOfficelistState($mapperObj->getOfficelistState());
        $mlsProperty->setOfficelistWeb($mapperObj->getOfficelistWeb());
        $mlsProperty->setOfficesellOfficenam2($mapperObj->getOfficesellOfficenam2());
        $mlsProperty->setOfficesell($mapperObj->getOfficesell());
        $mlsProperty->setOfficesellPhon2($mapperObj->getOfficesellPhon2());
        $mlsProperty->setHousingtype($mapperObj->getHousingtype());
        $mlsProperty->setPropsubtype($mapperObj->getPropsubtype());
        $mlsProperty->setCondoyn($mapperObj->getCondoyn());
        $mlsProperty->setYearbuilt($mapperObj->getYearbuilt());
        $mlsProperty->setListstatusflag($mapperObj->getListstatusflag());
        $mlsProperty->setAgentlist($mapperObj->getAgentlist());
        $mlsProperty->setAgentlistFullname($mapperObj->getAgentlistFullname());
        $mlsProperty->setAgentlistFirstname($mapperObj->getAgentlistFirstname());
        $mlsProperty->setAgentlistLastname($mapperObj->getAgentlistLastname());
        $mlsProperty->setAgentlistFax($mapperObj->getAgentlistFax());
        $mlsProperty->setAgentlistPhone($mapperObj->getAgentlistPhone());
        $mlsProperty->setAgentlistMobilenum1($mapperObj->getAgentlistMobilenum1());
        $mlsProperty->setAgentlistEmail($mapperObj->getAgentlistEmail());
        $mlsProperty->setAgentlistVoicmail1($mapperObj->getAgentlistVoicmail1());
        $mlsProperty->setAgentlistPagernum1($mapperObj->getAgentlistPagernum1());
        $mlsProperty->setAgentlistWeb($mapperObj->getAgentlistWeb());
        $mlsProperty->setHeatsystem($mapperObj->getHeatsystem());
        $mlsProperty->setAssocfee($mapperObj->getAssocfee());
        $mlsProperty->setCompsell($mapperObj->getCompsell());
        $mlsProperty->setAssocfeepaid($mapperObj->getAssocfeepaid());
        $mlsProperty->setBlock($mapperObj->getBlock());
        $mlsProperty->setCdom($mapperObj->getCdom());
        $mlsProperty->setDirections($mapperObj->getDirections());
        $mlsProperty->setSubdivision($mapperObj->getSubdivision());
        $mlsProperty->setCompbuy($mapperObj->getCompbuy());
        $mlsProperty->setDaysonmarket($mapperObj->getDaysonmarket());
        $mlsProperty->setBathshalf($mapperObj->getBathshalf());
        $mlsProperty->setBeds($mapperObj->getBeds());
        $mlsProperty->setBathstotal($mapperObj->getBathstotal());
        $mlsProperty->setStyle($mapperObj->getStyle());
        $mlsProperty->setAcres($mapperObj->getAcres());
        $mlsProperty->setExterior($mapperObj->getExterior());
        $mlsProperty->setFireplacedesc($mapperObj->getFireplacedesc());
        $mlsProperty->setGarage($mapperObj->getGarage());
        $mlsProperty->setInterior($mapperObj->getInterior());
        $mlsProperty->setOccupancy($mapperObj->getOccupancy());
        $mlsProperty->setRemarks($mapperObj->getRemarks());
        $mlsProperty->setRealremarks($mapperObj->getRealremarks());
        $mlsProperty->setShowinstr($mapperObj->getShowinstr());
        $mlsProperty->setConstruction($mapperObj->getConstruction());
        $mlsProperty->setHoa($mapperObj->getHoa());
        $mlsProperty->setStories($mapperObj->getStories());
        $mlsProperty->setUnitnum($mapperObj->getUnitnum());
        $mlsProperty->setTaxid($mapperObj->getTaxid());
        $mlsProperty->setLotnum($mapperObj->getLotnum());
        $mlsProperty->setLotsize($mapperObj->getLotsize());
        $mlsProperty->setLotdim($mapperObj->getLotdim());
        $mlsProperty->setBathsfull($mapperObj->getBathsfull());
        $mlsProperty->setOwnerName($mapperObj->getOwnerName());
        $mlsProperty->setAgentsell($mapperObj->getAgentsell());
        $mlsProperty->setAgentsellAgentname($mapperObj->getAgentsellAgentname());
        $mlsProperty->setSellerType($mapperObj->getSellerType());
        $mlsProperty->setStreetdirPrefix($mapperObj->getStreetdirPrefix());
        $mlsProperty->setStreetdirSuffix($mapperObj->getStreetdirSuffix());
        $mlsProperty->setDeedbook($mapperObj->getDeedbook());
        $mlsProperty->setDeedpage($mapperObj->getDeedpage());
        $mlsProperty->setZoningcode($mapperObj->getZoningcode());
        $mlsProperty->setSchooldistrict($mapperObj->getSchooldistrict());
        $mlsProperty->setOptionEntered($mapperObj->getOptionEntered());
        $mlsProperty->setPendingEntered($mapperObj->getPendingEntered());

        return $mlsProperty;
	}
}