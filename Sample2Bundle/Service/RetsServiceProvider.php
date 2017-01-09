<?php

namespace RetsBundle\Service;

use PHRETS\Configuration;
use PHRETS\Session;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use S3;

use RetsBundle\Entity\MlsPropertiesCursor;
use RetsBundle\Entity\LeasedMlsPropertiesCursor;
use RetsBundle\Entity\MlsProperties;
use RetsBundle\Entity\MlsLeaseProperties;
use RetsBundle\Entity\MlsPropertyPhotos;
use RetsBundle\Entity\Markets;

use RetsBundle\Adapter\mlsMarkets;

use RetsBundle\Adapter\Helper\mlsPropertiesUpdate;
use RetsBundle\Adapter\Helper\mlsPropertiesPersist;
use RetsBundle\Adapter\Helper\mlsLeasePropertiesUpdate;
use RetsBundle\Adapter\Helper\mlsLeasePropertiesPersist;
use RetsBundle\Adapter\Helper\mlsImageHelper;


/**
 * RETS Service Provider
 * Provides wcodewiseer class for PHRETS package
 */
class RetsServiceProvider
{
    /* @var config */
    private $config;

    /* @var session */
    private $session;

    /* @var em */
    private $em;

    /* @var logger */
    private $logger;

    /* @var imgBaseDir */
    private $imgBaseDir;

    /* @var awsAccessKey */
    private $awsAccessKey;

    /* @var awsSecretKey */
    private $awsSecretKey;

    /* @var awsbucketName */
    private $awsbucketName;

    public function __construct(EntityManager $em, LoggerInterface $logger, $awsAccessKey, $awsSecretKey, $awsbucketName)
    {
        $this->em = $em;
        $this->logger = $logger;
        $this->awsAccessKey = $awsAccessKey;
        $this->awsSecretKey = $awsSecretKey;
        $this->awsbucketName = $awsbucketName;
        $this->imgBaseDir = substr(__DIR__, 0, strpos(__DIR__, 'src')).'app/data/'; // TODO: define the Directory for temporary img storage
    }

    public function Retslogin()
    {
        return $this->session->Login();
    }

    public function RetsGetSystemMetadata()
    {
        return $this->session->GetSystemMetadata();
    }

    public function RetsGetClasses()
    {
        return $this->session->GetClassesMetadata('Property');
    }

    public function GetTableMetadata($property = 'Property', $type = 'A')
    {
        return $this->session->GetTableMetadata($property, $type);
    }

    /**
     * GetRetsObject
     * Gets an array of all Image objects
     * @param  string property
     * @param string objectType
     * @param string PhotoId
     */
    public function GetRetsObject($property = 'Property', $objectType = 'Photo', $MatrixUniqueID)
    {
        return $this->session->GetObject($property, $objectType, $MatrixUniqueID);
    }

    public function GetRetsMetadataObjects($property)
    {
        return $this->session->GetClassesMetadata($property);
    }

    /**
     * testS3Service
     * Test connection to S3 is successful
     * @returns list of available buckets for this credentials
     */
    public function testS3Service()
    {
        S3::setAuth($this->awsAccessKey, $this->awsSecretKey);

        return S3::listBuckets(true);
    }

    /**
     * GetAllLookupValues
     * Gets an array of all lookup values for the given Resource
     * @param  string resource
     */
    public function getAllLookupValues(string $resource= 'Property')
    {
        return $this->session->GetAllLookupValues($resource);
    }

    /**
     * Search RETS Server
     * @param string resource
     * @param string class
     * @param string query
     */
    public function RetsSearch(string $resource = 'Property', string $class = 'RESI', string $query = '(ListPrice=300000+)', int $limitResults = 500)
    {
        return $this->session->Search(
            $resource, 
            $class, 
            $query,
            [
                'QueryType' => 'DMQL2',
                'Count' => 1, // count and records
                'Format' => 'COMPACT-DECODED',
                'Limit' => $limitResults,
                'StandardNames' => 0, // give system names
            ]
        );
    }


    /**
     * Fetch Row from a Search result
     * @param object search
     */
    public function fetchRow(object $search)
    {
        return $this->session->FetchRow($search);
    }

    public function RetsLogout()
    {
        return $this->session->Logout();
    }  

    /**
     * startSession
     * Start new session in RETS Server
     * @param string market state
     */
    public function startSession($marketState)
    {
        $params = $this->em->getRepository('RetsBundle:RetsServers')->findOneBy(['stateName' => $marketState]);
        $this->config = new Configuration();
        $this->config->setLoginUrl($params->getServerUrl())
                ->setUsername($params->getServerUserName())
                ->setPassword($params->getServerPassword());

        $this->session = new Session($this->config);
        

        return $this->session;
    }

    public function getRetsSession()
    {
        return $this->session; 
    }

    /**
     * checkMlsPropertiesCursorActive
     * Check Sell Mls Properties cursor is active
     * @param string market state
     * @returns bool
     */
    public function checkMlsPropertiesCursorActive($marketState)
    {
        $mlsPropertiesCursor =  $this->em->getRepository('RetsBundle:MlsPropertiesCursor')->findOneBy(['marketLongName' => $marketState]);

        if(!$mlsPropertiesCursor) {
            return true;
        } else {
            return $mlsPropertiesCursor->getActive();
        }
    }

    /**
     * checkLeasedMlsPropertiesCursorActive
     * Check Lease Mls Properties cursor is active
     * @param string market state
     * @returns bool
     */
    public function checkLeasedMlsPropertiesCursorActive($marketState)
    {
        $LeasedMlsPropertiesCursor =  $this->em->getRepository('RetsBundle:MlsPropertiesCursor')->findOneBy(['marketLongName' => $marketState]);

        if(!$LeasedMlsPropertiesCursor) {
            return true;
        } else {
            return $LeasedMlsPropertiesCursor->getActive();
        }
    }

    /**
     * MlsPropertiesCursor
     * get Sell Mls Properties cursor
     * @param string market state
     */
    public function getMlsPropertiesCursor($marketState)
    {
        $mlsPropertiesCursor =  $this->em->getRepository('RetsBundle:MlsPropertiesCursor')->findOneBy(['marketLongName' => $marketState]);

        if(!$mlsPropertiesCursor) {
            $currentDateTime = new \dateTime;
            $mlsPropertiesCursor = new MlsPropertiesCursor();
            $market = $this->em->getRepository('RetsBundle:RetsServers')->findOneBy(['stateName' => $marketState]);
            $mlsPropertiesCursor->setMarketShortName($marketState);
            $mlsPropertiesCursor->setmarketLongName($market->getStateName());
            $mlsPropertiesCursor->setCursorTimeStamp($currentDateTime);
            $mlsPropertiesCursor->setActive(true);
            $this->em->persist($mlsPropertiesCursor);
            $this->em->flush($mlsPropertiesCursor);

            //Log transaction
            $this->logger->info('Created new Cursor for market:'.$marketState);
        }

        return $mlsPropertiesCursor;
    }

    /**
     * LeasedMlsPropertiesCursor
     * get Leased Mls Properties cursor
     * @param string market state
     */
    public function getLeasedMlsPropertiesCursor($marketState)
    {
        $leasedMlsPropertiesCursor =  $this->em->getRepository('RetsBundle:LeasedMlsPropertiesCursor')->findOneBy(['marketLongName' => $marketState]);

        if(!$leasedMlsPropertiesCursor) {
            $currentDateTime = new \dateTime;
            $leasedMlsPropertiesCursor = new LeasedMlsPropertiesCursor();
            $market = $this->em->getRepository('RetsBundle:RetsServers')->findOneBy(['stateName' => $marketState]);
            $leasedMlsPropertiesCursor->setMarketShortName($marketState);
            $leasedMlsPropertiesCursor->setmarketLongName($market->getStateName());
            $leasedMlsPropertiesCursor->setCursorTimeStamp($currentDateTime);
            $leasedMlsPropertiesCursor->setActive(true);
            $this->em->persist($leasedMlsPropertiesCursor);
            $this->em->flush($leasedMlsPropertiesCursor);

            //Log transaction
            $this->logger->info('Created new Cursor for market:'.$marketState);
        }

        return $leasedMlsPropertiesCursor;
    }
    /**
     * getMarketId
     * @param $marketState
     * returns integer marketId
     */
    public function getMarketId($marketState)
    {        
        $market = $this->em->getRepository('RetsBundle:Markets')->findOneBy(['name' => $marketState]);

        return $market->getId();
    }

    /**
     * getRetsResources
     * @param $marketState
     * returns object resources
     */
    public function getRetsResources($marketState, $type)
    {
        // TODO: Should these resources stored in markets or rets_servers table?
        return mlsMarkets::mlsMarketResources($marketState, $type);
    }

    /**
     * Query
     * get query string to search for Sell mls listings
     * @param Doctrine /MlsPropertiesCursor
     * @param datetime currentDateTime
     */
    public function getQuery(MlsPropertiesCursor $mlsPropertiesCursor, $currentDateTime, $queryDateName)
    {        
        $currentTimeStamp = $currentDateTime->format('Y-m-dTH:i:s.000');
        $currentTimeStamp = str_replace('CS', '', $currentTimeStamp);
        $mlsTimeStamp = ($mlsPropertiesCursor->getCursorTimeStamp())->format('Y-m-dTH:i:s.000');
        $mlsTimeStamp = str_replace('CS', '', $mlsTimeStamp);

        return "({$queryDateName}={$mlsTimeStamp}-{$currentTimeStamp})";
    }

    /**
     * LeasedQuery
     * get query string to search for Leased mls listings
     * @param Doctrine /LeasedMlsPropertiesCursor
     * @param datetime currentDateTime
     */
    public function getLeasedQuery(LeasedMlsPropertiesCursor $mlsPropertiesCursor, $currentDateTime, $queryDateName)
    {        
        $currentTimeStamp = $currentDateTime->format('Y-m-dTH:i:s.000');
        $currentTimeStamp = str_replace('CS', '', $currentTimeStamp);
        $mlsTimeStamp = ($mlsPropertiesCursor->getCursorTimeStamp())->format('Y-m-dTH:i:s.000');
        $mlsTimeStamp = str_replace('CS', '', $mlsTimeStamp);

        return "({$queryDateName}={$mlsTimeStamp}-{$currentTimeStamp})";
    }

    /**
     * updateCursor
     * Update Sell Mls properties cursor with new timestamp
     * @param string market state
     */
    public function updateCursor(MlsPropertiesCursor $mlsPropertiesCursor, $currentDateTime)
    {
        $mlsPropertiesCursor->setCursorTimeStamp($currentDateTime);
        $mlsPropertiesCursor->setActive(true);

        $this->em->flush($mlsPropertiesCursor);
    }

    /**
     * setMlsPropertiesCursorInactive
     * Update Sell Mls properties cursor to inactive
     * @param string market state
     */
    public function setMlsPropertiesCursorInactive(MlsPropertiesCursor $mlsPropertiesCursor)
    {
        $mlsPropertiesCursor->setActive(false);

        $this->em->flush($mlsPropertiesCursor);
    }

    /**
     * setMlsPropertiesCursorInactive
     * Update Sell Mls properties cursor to inactive
     * @param string market state
     */
    public function setMlsPropertiesCursorToOriginal(MlsPropertiesCursor $mlsPropertiesCursor)
    {
        $mlsPropertiesCursor->setActive(true);

        $this->em->flush($mlsPropertiesCursor);
    }

    /**
     * updateLeasedCursor
     * Update Leased Mls properties cursor with new timestamp
     * @param string market state
     */
    public function updateLeasedCursor(LeasedMlsPropertiesCursor $leasedMlsPropertiesCursor, $currentDateTime)
    {
        $leasedMlsPropertiesCursor->setCursorTimeStamp($currentDateTime);

        $this->em->flush($leasedMlsPropertiesCursor);
    }

    /**
     * persistMlsProperties
     * Persist Sell Mls properties
     * @param array collection mapperObjCollection
     * @param string marketState
     */
    public function persistMlsProperties($mapperObjCollection, $marketState)
    {

        $market = $this->em->getRepository('RetsBundle:Markets')->findOneBy(['name' => $marketState]);
        $marketId = $market->getId();

        // Connect to Amazon S3
        S3::setAuth($this->awsAccessKey, $this->awsSecretKey);

        foreach ($mapperObjCollection as $mapperObj) {

            // Insert or Update based on MlsNum  is on db or not
            $mlsProperty = $this->em->getRepository('RetsBundle:MlsProperties')->findOneBy(['mlsnum' => $mapperObj->getMlsnum(), 'marketId' => $marketId]);


            if($mlsProperty) {

                // Update Mls property
                $mlsPropertiesUpdate = new mlsPropertiesUpdate();
                $mlsProperty = $mlsPropertiesUpdate->mlsPropertiesMapUpdate($mlsProperty, $mapperObj);

                $this->em->persist($mlsProperty);
                $this->em->flush($mlsProperty);

                // log transaction
                $this->logger->info('Updating Sell '.$mapperObj->getMlsnum().' on '.($mapperObj->getDateUpdated())->format('Y-m-d H:i:s'));

            } else {

                // Insert new Mls property
                $mlsPropertiesPersist = new mlsPropertiesPersist();
                $mlsProperty = $mlsPropertiesPersist->mlsPropertiesMapPersist(new MlsProperties(), $mapperObj);

                $this->em->persist($mlsProperty);
                $this->em->flush($mlsProperty);

                // log transaction
                $this->logger->info('Inserting new Sell Mls Property:'.$mapperObj->getMlsnum());
            }

            // Pull Images and store them          
            if($mapperObj->getPhotoId() != 'none') {

                // Get Images Object from Rets Server
                $imagesObj = $this->GetRetsObject($property = 'Property', 'LargePhoto', $mapperObj->getPhotoId()); // Updating to get large Photos

                // Adding MlsNum to the storage route to avoid possible duplicates
                //$storageRoute = $this->imgBaseDir.$marketState.'/'.$mapperObj->getMlsnum().'_';

                // Modifying local storage route until fixing storage route in platform.sh
                // TODO: return to previous route
                $storageRoute = $this->imgBaseDir.$mapperObj->getMlsnum().'_';

                // Use Image Helper to Store new images in given route locally
                mlsImageHelper::storeImagesLocal($imagesObj, $storageRoute);
                
                // Adding Market State and MlsNum to the storage route to avoid possible duplicates
                $localStorageRoute = $storageRoute;
                $remoteStorageRoute = 'property/photos/'.$marketState.'/'.$mapperObj->getMlsnum().'_';

                // Use S3 Service to upload images to S3
                mlsImageHelper::storeImagesS3($imagesObj, $localStorageRoute, $remoteStorageRoute, $this->awsbucketName);

                // Get mlsProperty Id using mlsNum in mapped object
                $mlsProperty = $this->em->getRepository('RetsBundle:MlsProperties')->findOneBy(['mlsnum' => $mapperObj->getMlsnum(), 'marketId' => $marketId]);

                // Insert/Update S3 image details in DB
                mlsImageHelper::persistMlsPropertyPhotos($imagesObj, $localStorageRoute, $remoteStorageRoute, $this->awsbucketName, $this->em, $mlsProperty->getId());

                // After successful S3 Uploading delete local images
                mlsImageHelper::removeImagesLocal($imagesObj, $storageRoute);

            }

        }

    }

    /**
     * persistLeasedMlsProperties
     * Persist Leased Mls properties
     * @param array collection mapperObjCollection
     * @param string marketState
     */
    public function persistLeasedMlsProperties($mapperObjCollection, $marketState)
    {
        $market = $this->em->getRepository('RetsBundle:Markets')->findOneBy(['name' => $marketState]);
        $marketId = $market->getId();

        // Connect to Amazon S3
        S3::setAuth($this->awsAccessKey, $this->awsSecretKey);

        foreach ($mapperObjCollection as $mapperObj) {

            // Insert or Update based on MlsNum  is on db or not
            $mlsProperty = $this->em->getRepository('RetsBundle:MlsLeaseProperties')->findOneBy(['mlsnum' => $mapperObj->getMlsnum(), 'marketId' => $marketId]);


            if($mlsProperty) {

                // Update Mls property
                $mlsLeasePropertiesUpdate = new mlsLeasePropertiesUpdate();
                $mlsProperty = $mlsLeasePropertiesUpdate->mlsPropertiesMapUpdate($mlsProperty, $mapperObj);

                $this->em->persist($mlsProperty);
                $this->em->flush($mlsProperty);

                // log transaction
                $this->logger->info('Updating Lease '.$mapperObj->getMlsnum().' on '.($mapperObj->getDateUpdated())->format('Y-m-d H:i:s'));

            } else {

                // Insert new Mls property
                $mlsLeasePropertiesPersist = new mlsLeasePropertiesPersist();
                $mlsProperty = $mlsLeasePropertiesPersist->mlsPropertiesMapPersist(new MlsLeaseProperties(), $mapperObj);

                $this->em->persist($mlsProperty);
                $this->em->flush($mlsProperty);

                // log transaction
                $this->logger->info('Inserting new Lease Mls Property:'.$mapperObj->getMlsnum());
            }

            // Pull Images and store them          
            if($mapperObj->getPhotoId() != 'none') {

                // Get Images Object from Rets Server
                $imagesObj = $this->GetRetsObject($property = 'Property', 'LargePhoto', $mapperObj->getPhotoId()); // Updating to get large Photos

                // TODO: Set appropiate base dir for images
                $storageRoute = $this->imgBaseDir.$marketState.'/'.$mapperObj->getMlsnum().'_';

                // Use Image Helper to Store new images in given route locally
                mlsImageHelper::storeImagesLocal($imagesObj, $storageRoute);
                
                // Adding Market State and MlsNum to the storage route to avoid possible duplicates
                $localStorageRoute = $storageRoute;
                $remoteStorageRoute = 'property/photos/'.$marketState.'/'.$mapperObj->getMlsnum().'_';

                // Use S3 Service to upload images to S3
                mlsImageHelper::storeImagesS3($imagesObj, $localStorageRoute, $remoteStorageRoute, $this->awsbucketName);

                // Get mlsProperty Id using mlsNum in mapped object
                $mlsProperty = $this->em->getRepository('RetsBundle:MlsProperties')->findOneBy(['mlsnum' => $mapperObj->getMlsnum(), 'marketId' => $marketId]);

                // Insert/Update S3 image details in DB
                mlsImageHelper::persistMlsPropertyPhotos($imagesObj, $localStorageRoute, $remoteStorageRoute, $this->awsbucketName, $this->em, $mlsProperty->getId());

                // After successful S3 Uploading delete local images
                mlsImageHelper::removeImagesLocal($imagesObj, $storageRoute);

            }

        }

    }
}