<?php

namespace RetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use RetsBundle\Model\RetsSearchFormModel;

/*
 * This Controller is used only for dumping some info from the Rets Server
 * All functionality is executed by the Command scripts
 *
 */
class RetsController extends Controller
{

    /**
     * @Route("/")
     * @Template("RetsBundle:Default:index.html.twig")
     */
    public function indexAction()
    {

        $comm = 'Index to display basic options';

        return array(
            'comm' => $comm            
            );
    }

    /**
     * @Route("/getClasses/{marketState}", name="rets_classes_metadata")
     * @Template("RetsBundle:Default:getClasses.html.twig")
     */
    public function getClassesAction($marketState)
    {
        $retsService = $this->get('rets.service.provider');

        // Start a new Session        
        $init = $retsService->startSession($marketState);

        // Login to the Rets Server
        $connect = $retsService->Retslogin();

        // Get Classes Meta Data from Rets Server
        //$system = $retsService->RetsGetSystemMetadata();
        //$resources = $system->getResources();
        //$classes = $resources->first()->getClasses();

        $classes = $retsService->RetsGetClasses();

        dump($classes);
        die('here');

        return array(
            'entities' => $results,
        );
    }

    /**
     * @Route("/getTableMetadata/{state}/{property}/{type}", name="rets_table_metadata")
     * @Template("RetsBundle:Default:getTableMetadata.html.twig")
     */
    public function getTableMetadataAction($state, $property, $type)
    {
        $retsService = $this->get('rets.service.provider');

        // Start a new Session        
        $init = $retsService->startSession($state);

        // Login to the Rets Server
        $connect = $retsService->Retslogin();

        // Get Table Meta Data from Rets Server
        $fields = $retsService->GetTableMetadata($property, $type);

        dump($fields);
        die('here');

        return array(
            'entities' => $results,
        );
    }

    /**
     * @Route("/getMetadataObjects/{state}/{property}", name="rets_metadata_objects")
     * @Template("RetsBundle:Default:getMetadataObjects.html.twig")
     */
    public function getMetadataObjectsAction($state, $property)
    {
        $retsService = $this->get('rets.service.provider');

        // Start a new Session        
        $init = $retsService->startSession($state);

        // Login to the Rets Server
        $connect = $retsService->Retslogin();

        // Get Table Meta Data from Rets Server
        $objects = $retsService->GetRetsMetadataObjects($property);

        dump($objects);
        die('here');

        return array(
            'entities' => $results,
        );
    }

    /**
     * @Route("/testS3Service", name="rets_testS3Service")
     * @Template("RetsBundle:Default:getMetadataObjects.html.twig")
     */
    public function testS3ServiceAction()
    {
        $retsService = $this->get('rets.service.provider');

        // Get a list of buckets
        $results = $retsService->testS3Service();

        print_r($results);
        die('here');

        return array(
            'entities' => $results,
        );
    }

    /**
     * @Route("/getRetsObject/{state}/{MatrixUniqueID}", name="rets_get_object")
     * @Template("RetsBundle:Default:getRetsObject.html.twig")
     */
    public function getRetsObjectAction($state, $MatrixUniqueID)
    {
        $storageRoute = $_SERVER['DOCUMENT_ROOT'].'/images/mlsProperties/'.$state.'/';

        $retsService = $this->get('rets.service.provider');

        // Start a new Session        
        $init = $retsService->startSession($state);

        // Login to the Rets Server
        $connect = $retsService->Retslogin();

        // Get Photos Object from Rets Server
        $photos = $retsService->GetRetsObject($property = 'Property', 'Photo', $MatrixUniqueID);

        foreach ($photos as $img) {
            if ($img->getContentType() == 'image/jpeg') {

                $imgName = $storageRoute.$img->getContentId().'_'.$img->getObjectId().'.jpg';
                $imgBinaryData = $img->getContent();
                $this->processImage($imgBinaryData, $imgName);

                print_r($imgName);
            }
            
        }
        dump($photos);
        die('done');

        return array(
            'entities' => $results,
        );
    }

// Image processing -- Included here for testing purposes only
// TODO: move to an appropiate service if think would be useful to keep
private function processImage($imgBinaryData, $savename){

        // Decode Binary data
        $data = $imgBinaryData;
        //$data = base64_decode($data);

        // Create image
        $im = imagecreatefromstring($data);

        // Save image
        imagejpeg($im, $savename, 95);
}

    /**
     * @Route("/searchResults/{state}/{property}/{type}/{query}/{limitResults}", name="rets_search_results")
     * @Template("RetsBundle:Default:searchResults.html.twig")
     */
    public function searchResultsAction($state, $property, $type, $query, $limitResults)
    {
        $retsService = $this->get('rets.service.provider');

        // Start a new Session        
        $init = $retsService->startSession($state);

        // Login to the Rets Server
        $connect = $retsService->Retslogin();
        
        // Try the search with provided parameters
        try {
            $response = $retsService->RetsSearch($property, $type, $query, $limitResults);
        } 
        catch (\Exception $e) {
            die('an error happened');
        }

        $results = [];
        $num= count($response);
        foreach ($response as $items) {
            array_push($results, $items);
        }

        dump($results);
        die('here');

        return array(
            'entities' => $results,
            'State' => $state,
            'Property' => $property,
            'type' => $type,
            'num' => $num,
            'query' => $query,           
            );
    }

    /**
     * Form to Search RETS Server using available query params
     *
     * @Route("/searchForm", name="rets_search_form")
     * @Template("RetsBundle:Default:searchForm.html.twig")
     */
    public function searchFormAction(Request $request)
    {
        $retsSearchFormModel = new Retssearchformmodel();
        $form = $this->createForm('RetsBundle\Form\RetsSearchFormModelType', $retsSearchFormModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            $listPriceMin = $formData->getListPriceMin();
            $listPriceMax = $formData->getListPriceMax();
            $status = $formData->getStatus();
            $yearBuildMin = $formData->getYearBuildMin();
            $yearBuildMax = $formData->getYearBuildMax();
            $listingContractDateMin = $formData->getListingContractDateMin();
            $listingContractDateMax = $formData->getListingContractDateMax();
            $postalCode = $formData->getPostalCode();
            
            $query = "(ListPrice={$listPriceMin}-{$listPriceMax})";
            $query .= ",(YearBuilt={$yearBuildMin}-{$yearBuildMax})";
            $query .= ",(ListingContractDate={$listingContractDateMin}-{$listingContractDateMax})";
            //$query .= ",(PostalCode={$postalCode})";
            //$query .= "(Status={$status})";
             
            //print_r($query);
            //die();
            //$query = "(ListPrice=300000+),(YearBuilt=2005+),(ListingContractDate=2016-09-24T00:00:00.000-2016-10-24T00:00:00.000)";

            return $this->redirectToRoute('rets_search_results', array(
                                                                        'state' => $formData->getState(),
                                                                        'property' => $formData->getPropertyType(),
                                                                        'type' => $formData->getPropertyClass(),
                                                                        'query' => $query,
                                                                        ));
        }

        return array(
            'retsSearchFormModel' => $retsSearchFormModel,
            'form' => $form->createView(),
        );
    }

    /**
     * Search RETS Server for specific MLS# and returns json response
     *
     * @Route("/searchMls/{state}/{property}/{type}/{mlsNumber}", name="rets_search_mls")
     */
    public function searchMlsAction($state, $property, $type, $mlsNumber)
    {
        $retsService = $this->get('rets.service.provider');

        // Start a new Session        
        $init = $retsService->startSession($state);

        // Login to the Rets Server
        $connect = $retsService->Retslogin();

        $query = "(MLSNumber={$mlsNumber})";

        die($query);

        // Try the search with provided parameters
        try {
            $response = $retsService->RetsSearch($property, $type, $query);
        } 
        catch (\Exception $e) {
            die('an error happened');
        }

        return new JsonResponse($response);  
    }
}
