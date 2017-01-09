<?php

namespace RAPP\Bundle\LoyaltyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

use RAPP\Bundle\LoyaltyBundle\Model\LoyaltyChallenge;
use RAPP\Bundle\LoyaltyBundle\Form\LoyaltyChallengeType;

/**
 * Loyalty Challenge controller.
 *
 * @Route("/LimitedTimeOffers")
 */
class LoyaltyChallengeController extends Controller
{

    /**
     * Lists available Challenges.
     *
     * @Route("/LoyaltyChallenge/{status}", name="LoyaltyChallenges", defaults= {"status" = 0}, requirements = {"status"="2|1|0"})
     * @Template("RAPPLoyaltyBundle:LoyaltyChallenge:index.html.twig")
     */
    public function LoyaltyChallengeAction($status)
    {

        switch ($status) {
            case 1:
                $results = $this->get('rapp_loyalty.loyalty_service')->getAvailableChallenges('active');
                $status = 1;
                break;
            case 2:
                $results = $this->get('rapp_loyalty.loyalty_service')->getAvailableChallenges('archive');
                $status = 2;
                break;
            case 0:
            default:
                $results = $this->get('rapp_loyalty.loyalty_service')->getAvailableChallenges('draft');
                $status = 0;
                break;
        }
        
        if ($results->errorCode == '00000001') {
            $challenges = $results->challenges;
            $error = 0;
        } else {
            $challenges = array();
            $error = 1;
        }

        return array(
            'entities' => $challenges,
            'status' => $status,
            'error' => $error
        );
    }

    /**
     * Render the Loyalty Challenge form.
     *
     * @Route("/LoyaltyChallenge/create", name="LoyaltyChallengeCreate")
     * @Template("RAPPLoyaltyBundle:LoyaltyChallenge:create.html.twig")
     */
    public function LoyaltyChallengeCreateAction()
    {
        $request = $this->getRequest();

        $entity = New LoyaltyChallenge();        

        $error = 0;

        $checkCategory = $this->get('rapp_loyalty.loyalty_service')->getCheckCategories();

        $rewards = $this->get('rapp_loyalty.loyalty_service')->getRewards();

        $challengeCategories = $this->get('rapp_loyalty.loyalty_service')->getChallengeCategories();
        
        $createForm = $this->createCreateForm($entity, $checkCategory->allCheckCategories, $rewards->getRewards, $challengeCategories->getChallengeCategories);

        $createForm->handleRequest($request);

        if ($createForm->isValid()) {
                $entity = $createForm->getData();
                
                $startDate = $entity->getStartDate();
                $startDate = $startDate->setTime(7, 0);

                $endDate = $entity->getEndDate();
                $endDate = $endDate->setTime(7, 0);

                $entity->setStartDate($startDate);
                $entity->setEndDate($endDate);

                if (!$entity->getChallengeRequirements1()){$entity->setChallengeRequirements1('');}
                if (!$entity->getChallengeRequirements2()){$entity->setChallengeRequirements2('');}

                $result = $this->get('rapp_loyalty.loyalty_service')->createChallenge($entity);
                
                if ($result->errorCode == '00000001') {
                    $error = 0;
                } else {
                    switch ($result->errorCode) {
                        case '00000989':
                            $error = 1;
                            break;
                        case '00000988':
                            $error = 2;
                            break;
                        default:
                            $error = 3;
                            break;
                    }

                    return array(
                            'entity' => $entity,
                            'form'   => $createForm->createView(),
                            'error' => $error
                        );
                }
                
                return $this->redirect($this->generateUrl('LoyaltyChallenges'));
            }

        return array(
            'entity' => $entity,
            'form'   => $createForm->createView(),
            'error' => $error
        );
    }

    /**
     * Displays a form to Clone an existing Challenge entity.
     *
     * @Route("/LoyaltyChallenge/{id}/clone", name="LoyaltyChallengeClone")
     * @Template("RAPPLoyaltyBundle:LoyaltyChallenge:clone.html.twig")
     */
    public function cloneAction(Request $request, $id)
    {

        $request = $this->getRequest();

        $entity = New LoyaltyChallenge();        

        $error = 0;

        $results = $this->get('rapp_loyalty.loyalty_service')->getChallenge($id);

        $checkCategory = $this->get('rapp_loyalty.loyalty_service')->getCheckCategories();

        $rewards = $this->get('rapp_loyalty.loyalty_service')->getRewards();

        $challengeCategories = $this->get('rapp_loyalty.loyalty_service')->getChallengeCategories();

        $data = $results->challenge;

            $entity->setId($data->getId());
            $entity->setName($data->getName());
            $entity->setSummary($data->getSummary());
            $entity->setWebDescription($data->getWebDescription());
            $entity->setWebDisclaimer($data->getWebDisclaimer());
            $entity->setWebImage($data->getWebImage());
            $entity->setEmailDescription($data->getEmailDescription());
            $entity->setEmailDisclaimer($data->getEmailDisclaimer());
            $entity->setEmailImage($data->getEmailImage());
            $entity->setZioskDescription($data->getZioskDescription());
            $entity->setZioskDisclaimer($data->getZioskDisclaimer());
            $entity->setZioskImage($data->getZioskImage());
            $entity->setSequence($data->getSequence());
            $entity->setMinPoints($data->getMinPoints());
            $entity->setMaxPoints($data->getMaxPoints());
            $entity->setEarnLimit($data->getEarnLimit());
            $entity->setOfferLimit($data->getOfferLimit());
            $entity->setPointLevel1(null);
            $entity->setPointLevel2(null);
            $entity->setPointLevel3(null);
            $entity->setPointLevel4(null);
            $entity->setPointLevel5(null);
            $entity->setStaleHoldout($data->getStaleHoldout());
            $entity->setStartDelay($data->getStartDelay());
            $entity->setDuration($data->getDuration());
            $entity->setActive($data->getActive());
            $entity->setExclude($data->getExclude());
            $entity->setMultiplier($data->getMultiplier());
            $entity->setCampaignId(null);
            $entity->setSku(null);
            $entity->setSlug(null);
            $entity->setStartDate( new \DateTime());
            $entity->setEndDate( new \DateTime());
            $entity->setStartDate( $entity->getStartDate()->modify('+2 day'));
            $entity->setEndDate( $entity->getEndDate()->modify('+3 day'));
            $entity->setCategoryId($data->getCategoryId());

        

        $createForm = $this->createCloneForm($entity, $checkCategory->allCheckCategories, $rewards->getRewards, $challengeCategories->getChallengeCategories);

        $createForm->handleRequest($request);

        if ($createForm->isValid()) {
                $entity = $createForm->getData();
                
                $startDate = $entity->getStartDate();
                $startDate = $startDate->setTime(7, 0);

                $endDate = $entity->getEndDate();
                $endDate = $endDate->setTime(7, 0);

                $entity->setStartDate($startDate);
                $entity->setEndDate($endDate);

                if (!$entity->getChallengeRequirements1()){$entity->setChallengeRequirements1('');}
                if (!$entity->getChallengeRequirements2()){$entity->setChallengeRequirements2('');}

                $result = $this->get('rapp_loyalty.loyalty_service')->createChallenge($entity);
                
                if ($result->errorCode == '00000001') {
                    $error = 0;
                } else {
                    switch ($result->errorCode) {
                        case '00000989':
                            $error = 1;
                            break;
                        case '00000988':
                            $error = 2;
                            break;
                        default:
                            $error = 3;
                            break;
                    }

                    return array(
                            'entity' => $entity,
                            'form'   => $createForm->createView(),
                            'error' => $error
                        );
                }
                
                return $this->redirect($this->generateUrl('LoyaltyChallenges'));
            }

        return array(
            'entity' => $entity,
            'form'   => $createForm->createView(),
            'error' => $error
        );

    }

    /**
     * Creates a form to create a LoyaltyChallenge entity.
     *
     * @param LoyaltyChallenge $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(LoyaltyChallenge $entity, $checkCategory, $getRewards, $challengeCategories)
    {
        $form = $this->createForm(new LoyaltyChallengeType($checkCategory, $getRewards, $challengeCategories), $entity, array(
            'action' => $this->generateUrl('LoyaltyChallengeCreate'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Creates a form to clone a LoyaltyChallenge entity.
     *
     * @param LoyaltyChallenge $challenge The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCloneForm(LoyaltyChallenge $challenge, $checkCategory, $getRewards, $challengeCategories)
    {
        $form = $this->createForm(new LoyaltyChallengeType($checkCategory, $getRewards, $challengeCategories), $challenge, array(
            'action' => $this->generateUrl('LoyaltyChallengeClone', array('id' => $challenge->getId())),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to edit an existing Challenge entity.
     *
     * @Route("/LoyaltyChallenge/{id}/edit", name="LoyaltyChallengeEdit")
     * @Template("RAPPLoyaltyBundle:LoyaltyChallenge:edit.html.twig")
     */
    public function editAction(Request $request, $id)
    {
        $error = 0;

        $results = $this->get('rapp_loyalty.loyalty_service')->getChallenge($id);

        $checkCategory = $this->get('rapp_loyalty.loyalty_service')->getCheckCategories();

        $rewards = $this->get('rapp_loyalty.loyalty_service')->getRewards();

        $challengeCategories = $this->get('rapp_loyalty.loyalty_service')->getChallengeCategories();
                
        $entity = $results->challenge;
        
        $editForm = $this->createEditForm($entity, $checkCategory->allCheckCategories, $rewards->getRewards, $challengeCategories->getChallengeCategories);

        $editForm->handleRequest($request);        

            if ($editForm->isValid()) {
                $entity = $editForm->getData();
                
                $startDate = $entity->getStartDate();
                $startDate = $startDate->setTime(7, 0);

                $endDate = $entity->getEndDate();
                $endDate = $endDate->setTime(7, 0);

                $entity->setStartDate($startDate);
                $entity->setEndDate($endDate);

                // Removing Point Levels from the form as requested by GR
                // But keeping all th logic for backward compability or future needs
                $entity->setPointLevel1(null);
                $entity->setPointLevel2(null);
                $entity->setPointLevel3(null);
                $entity->setPointLevel4(null);
                $entity->setPointLevel5(null);

                if (!$entity->getChallengeRequirements1()){$entity->setChallengeRequirements1('');}
                if (!$entity->getChallengeRequirements2()){$entity->setChallengeRequirements2('');}
                
                $result = $this->get('rapp_loyalty.loyalty_service')->updateChallenge($entity, $id);

                if ($result->errorCode == '00000001') {
                    $error = 0;
                } else {
                    $error = 1;
                }
                
                return $this->redirect($this->generateUrl('LoyaltyChallenges'));
            }

            return array(
                'entity' => $entity,
                'form'   => $editForm->createView(),
                'error' => $error
            );

    }

    /**
    * Creates a form to edit a Challenge entity.
    *
    * @param LoyaltyChallenge $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(LoyaltyChallenge $entity, $checkCategory, $getRewards, $challengeCategories)
    {
        $form = $this->createForm(new LoyaltyChallengeType($checkCategory, $getRewards, $challengeCategories), $entity, array(
            'action' => $this->generateUrl('LoyaltyChallengeEdit', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Deletes existing Challenge entity.
     *
     * @Route("/LoyaltyChallenge/{id}/delete", name="LoyaltyChallengeDelete")
     * @Template("RAPPLoyaltyBundle:LoyaltyChallenge:index.html.twig")
     */
    public function deleteAction(Request $request, $id)
    {
        $result = $this->get('rapp_loyalty.loyalty_service')->deleteChallenge($id);
                
        return $this->redirect($this->generateUrl('LoyaltyChallenges'));
    }

    /**
     * Ajax route to check Unique Campaign Id.
     *
     * @Route("/checkCampaignId", name="LoyaltyChallengescheckCampaignId")
     */
    public function checkCampaignIdAction(Request $request)
    {
        $data = $request->get('LoyaltyChallenge');

        $newId = $data['campaignId'];

        $results = $this->get('rapp_loyalty.loyalty_service')->checkChallengeCampaignId($newId);

        if ($results->challenge) {            
            $challenge = $results->challenge;
            $success = 0;
        } else {
            $success = 1;
        }

        $result = array('success' => $success);

        return new JsonResponse($result);
    }

    /**
     * Ajax route to check Unique Sku.
     *
     * @Route("/checkSku", name="LoyaltyChallengescheckSku")
     */
    public function checkSkuAction(Request $request)
    {
        $data = $request->get('LoyaltyChallenge');

        $newId = $data['sku'];

        $results = $this->get('rapp_loyalty.loyalty_service')->checkChallengeSku($newId);

        if ($results->challenge) {            
            $challenge = $results->challenge;
            $success = 0;
        } else {
            $success = 1;
        }

        $result = array('success' => $success);
        
        return new JsonResponse($result);
    }

    /**
     * Ajax route to check Unique Slug.
     *
     * @Route("/checkSlug", name="LoyaltyChallengescheckSlug")
     */
    public function checkSlugAction(Request $request)
    {
        $data = $request->get('LoyaltyChallenge');

        $newId = $data['slug'];

        $results = $this->get('rapp_loyalty.loyalty_service')->checkChallengeSlug($newId);

        if ($results->challenge) {            
            $challenge = $results->challenge;
            $success = 0;
        } else {
            $success = 1;
        }

        $result = array('success' => $success);
        
        return new JsonResponse($result);
    }

    /**
     * Ajax route to check Unique Campaign Id for Edit.
     *
     * @Route("/checkCampaignIdEdit", name="LoyaltyChallengescheckCampaignIdEdit")
     */
    public function checkCampaignIdEditAction(Request $request)
    {
        $data = $request->get('LoyaltyChallenge');
        
        $results = $this->get('rapp_loyalty.loyalty_service')->checkChallengeCampaignIdEdit($data['campaignId'], $data['entityId']);

        if ($results->challenge) {            
            $challenge = $results->challenge;
            $success = 0;
        } else {
            $success = 1;
        }

        $result = array('success' => $success);

        return new JsonResponse($result);
    }

    /**
     * Ajax route to check Unique Sku for Edit.
     *
     * @Route("/checkSkuEdit", name="LoyaltyChallengescheckSkuEdit")
     */
    public function checkSkuEditAction(Request $request)
    {
        $data = $request->get('LoyaltyChallenge');

        $results = $this->get('rapp_loyalty.loyalty_service')->checkChallengeSkuEdit($data['sku'], $data['entityId']);

        if ($results->challenge) {            
            $challenge = $results->challenge;
            $success = 0;
        } else {
            $success = 1;
        }

        $result = array('success' => $success);
        
        return new JsonResponse($result);
    }

    /**
     * Ajax route to check Unique Slug for Edit.
     *
     * @Route("/checkSlugEdit", name="LoyaltyChallengescheckSlugEdit")
     */
    public function checkSlugEditAction(Request $request)
    {
        $data = $request->get('LoyaltyChallenge');

        $results = $this->get('rapp_loyalty.loyalty_service')->checkChallengeSlugEdit($data['slug'], $data['entityId']);

        if ($results->challenge) {            
            $challenge = $results->challenge;
            $success = 0;
        } else {
            $success = 1;
        }

        $result = array('success' => $success);
        
        return new JsonResponse($result);
    }

    /**
     * Activates existing Challenge entity.
     *
     * @Route("/LoyaltyChallenge/{id}/activate", name="LoyaltyChallengeActivate")
     * @Template("RAPPLoyaltyBundle:LoyaltyChallenge:index.html.twig")
     */
    public function activateAction(Request $request, $id)
    {
        $result = $this->get('rapp_loyalty.loyalty_service')->activateChallenge($id);
                
        return $this->redirect($this->generateUrl('LoyaltyChallenges'));
    }

    /**
     * Get Challenge entity.
     *
     * @Route("/LoyaltyChallenge/{id}/view", name="LoyaltyChallengeView")
     * @Template("RAPPLoyaltyBundle:LoyaltyChallenge:view.html.twig")
     */
    public function LoyaltyChallengeViewAction(Request $request, $id)
    {
        $results= $this->get('rapp_loyalty.loyalty_service')->getChallenge($id);

        $entity = $results->challenge;
                               
        return array('entity' => $entity);
    }

}
