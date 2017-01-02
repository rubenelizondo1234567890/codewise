<?php

namespace RetsBundle\Adapter\Helper;


use RetsBundle\Entity\MlsLeaseProperties;

/**
 * mlsLeasePropertiesPersist
 * Helps on preparing MLS Properties setting required fields
 */
class mlsLeasePropertiesPersist
{
	/**
     * mlsPropertiesMapPersist
     * Prepare for persisting Mls properties
     * @param object $mlsProperties
     * @param object $mapperObj
     */
	public function mlsPropertiesMapPersist(MlsLeaseProperties $mlsProperty, $mapperObj)
	{
		$mlsProperty->setMarketId($mapperObj->getMarketId());
        $mlsProperty->setDateCreated($mapperObj->getDateCreated());
        $mlsProperty->setDateUpdated($mapperObj->getDateUpdated());
        $mlsProperty->setDateAlvCalculated($mapperObj->getDateAlvCalculated());
        $mlsProperty->setNeedsAlvCalculation($mapperObj->getNeedsAlvCalculation());
        $mlsProperty->setLatitude($mapperObj->getLatitude());
        $mlsProperty->setLongitude($mapperObj->getLongitude());

        //TODO: Investigate how to get Photo Id and Photo file url for each mls property
        $mlsProperty->setPhotoId(($mapperObj->getPhotoId())? $mapperObj->getPhotoId() : 'none');

        $mlsProperty->setPhotoFile($mapperObj->getPhotoFile());
        $mlsProperty->setPhotoCount($mapperObj->getPhotoCount());
        $mlsProperty->setPhotoUpdated($mapperObj->getPhotoUpdated());
        $mlsProperty->setPhotoModified($mapperObj->getPhotoModified());
        $mlsProperty->setMlsnum($mapperObj->getMlsnum());
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
        $mlsProperty->setPendingdate($mapperObj->getPendingdate());
        $mlsProperty->setCloseddate($mapperObj->getCloseddate());
        $mlsProperty->setExpiredateoption($mapperObj->getExpiredateoption());

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

        return $mlsProperty;
	}
}