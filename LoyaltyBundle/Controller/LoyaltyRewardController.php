<?php

namespace RAPP\Bundle\LoyaltyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

use RAPP\Bundle\LoyaltyBundle\Model\LoyaltyReward;
use RAPP\Bundle\LoyaltyBundle\Form\LoyaltyRewardType;
/**
 * Loyalty Reward controller.
 *
 * @Route("/LimitedTimeOffers")
 */
class LoyaltyRewardController extends Controller
{

    /**
     * Lists available Rewards.
     *
     * @Route("/LoyaltyReward/{status}", name="LoyaltyRewards", defaults= {"status" = 0}, requirements = {"status"="3|2|1|0"})
     * @Template("RAPPLoyaltyBundle:LoyaltyReward:index.html.twig")
     */
    public function LoyaltyRewardAction($status)
    {

        switch ($status) {
            case 1:
                $results = $this->get('rapp_loyalty.loyalty_service')->getRewards('active');
                $status = 1;
                break;
            case 2:
                $results = $this->get('rapp_loyalty.loyalty_service')->getRewards('archive');
                $status = 2;
                break;
            case 0:
            default:
                $results = $this->get('rapp_loyalty.loyalty_service')->getRewards('draft');
                $status = 0;
                break;
        }

        if ($results->errorCode == '00000001') {
            $getRewards = $results->getRewards;
            $error = 0;
        } else {
            $getRewards = array();
            $error = 1;
        }

        return array(
            'entities' => $getRewards,
            'status' => $status,
            'error' => $error
        );
    }

    /**
     * Render the Loyalty Reward form.
     *
     * @Route("/LoyaltyReward/create", name="LoyaltyRewardCreate")
     * @Template("RAPPLoyaltyBundle:LoyaltyReward:create.html.twig")
     */
    public function LoyaltyRewardCreateAction()
    {
        $request = $this->getRequest();

        $entity = New LoyaltyReward();

        $error = 0;

        $rewardPrograms = $this->get('rapp_loyalty.loyalty_service')->getRewardPrograms();
        
        $createForm = $this->createCreateForm($entity, $rewardPrograms->getRewardPrograms);

        $createForm->handleRequest($request);

        if ($createForm->isValid()) {
                $entity = $createForm->getData();
                
                $startDate = $entity->getStartDate();
                $startDate = $startDate->setTime(7, 0);

                $endDate = $entity->getEndDate();
                $endDate = $endDate->setTime(7, 0);

                $entity->setStartDate($startDate);
                $entity->setEndDate($endDate);

                $entity->setMonetaryValue(0);
                $entity->setIsClaimable(true);
                
                $result = $this->get('rapp_loyalty.loyalty_service')->createReward($entity);
                
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
                        case '00000987':
                            $error = 4;
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
                
                return $this->redirect($this->generateUrl('LoyaltyRewards'));
            }

        return array(
            'entity' => $entity,
            'form'   => $createForm->createView(),
            'error' => $error
        );
    }

    /**
     * Creates a form to create a Loyalty Reward entity.
     *
     * @param Loyalty Reward $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(LoyaltyReward $entity, $rewardPrograms)
    {
        $form = $this->createForm(new LoyaltyRewardType($rewardPrograms), $entity, array(
            'action' => $this->generateUrl('LoyaltyRewardCreate'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to edit an existing Reward entity.
     *
     * @Route("/LoyaltyReward/{id}/edit", name="LoyaltyRewardEdit")
     * @Template("RAPPLoyaltyBundle:LoyaltyReward:edit.html.twig")
     */
    public function editAction(Request $request, $id)
    {
        $error = 0;

        $results = $this->get('rapp_loyalty.loyalty_service')->getReward($id);
                
        $entity = $results->reward;

        $rewardPrograms = $this->get('rapp_loyalty.loyalty_service')->getRewardPrograms();
        
        $editForm = $this->createEditForm($entity, $rewardPrograms->getRewardPrograms);

        $editForm->handleRequest($request);        

            if ($editForm->isValid()) {
                $entity = $editForm->getData();
                
                $startDate = $entity->getStartDate();
                $startDate = $startDate->setTime(7, 0);

                $endDate = $entity->getEndDate();
                $endDate = $endDate->setTime(7, 0);

                $entity->setStartDate($startDate);
                $entity->setEndDate($endDate);
                              
                $result = $this->get('rapp_loyalty.loyalty_service')->updateReward($entity, $id);

                if ($result->errorCode == '00000001') {
                    $error = 0;
                } else {
                    $error = 1;
                }
                
                return $this->redirect($this->generateUrl('LoyaltyRewards'));
            }

            return array(
                'entity' => $entity,
                'form'   => $editForm->createView(),
                'error' => $error
            );
    }

    /**
    * Creates a form to edit a LoyaltyReward entity.
    *
    * @param LoyaltyReward $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(LoyaltyReward $entity, $rewardPrograms)
    {
        $form = $this->createForm(new LoyaltyRewardType($rewardPrograms), $entity, array(
            'action' => $this->generateUrl('LoyaltyRewardEdit', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Deletes existing Reward entity.
     *
     * @Route("/LoyaltyReward/{id}/delete", name="LoyaltyRewardDelete")
     * @Template("RAPPLoyaltyBundle:LoyaltyReward:index.html.twig")
     */
    public function deleteAction(Request $request, $id)
    {
        $result = $this->get('rapp_loyalty.loyalty_service')->deleteReward($id);
                
        return $this->redirect($this->generateUrl('LoyaltyRewards'));
    }

    /**
     * Activates existing Reward entity.
     *
     * @Route("/LoyaltyReward/{id}/activate", name="LoyaltyRewardActivate")
     * @Template("RAPPLoyaltyBundle:LoyaltyReward:index.html.twig")
     */
    public function activateAction(Request $request, $id)
    {
        $result = $this->get('rapp_loyalty.loyalty_service')->activateReward($id);
                
        return $this->redirect($this->generateUrl('LoyaltyRewards'));
    }

    /**
     * Get Reward entity.
     *
     * @Route("/LoyaltyReward/{id}/view", name="LoyaltyRewardView")
     * @Template("RAPPLoyaltyBundle:LoyaltyReward:view.html.twig")
     */
    public function LoyaltyRewardViewAction(Request $request, $id)
    {
        $results = $this->get('rapp_loyalty.loyalty_service')->getReward($id);
                
        $entity = $results->reward;

        return array('entity' => $entity);
    }

    /**
     * Ajax route to check Unique Slug.
     *
     * @Route("/LoyaltyReward/checkSlug", name="LoyaltyRewardcheckSlug")
     */
    public function checkSlugAction(Request $request)
    {
        $data = $request->get('LoyaltyReward');

        $newId = $data['slug'];

        $results = $this->get('rapp_loyalty.loyalty_service')->checkRewardSlug($newId);

        if ($results->reward) {            
            $reward = $results->reward;
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
     * @Route("/LoyaltyReward/checkSlugEdit", name="LoyaltyRewardcheckSlugEdit")
     */
    public function checkSlugEditAction(Request $request)
    {
        $data = $request->get('LoyaltyReward');

        $results = $this->get('rapp_loyalty.loyalty_service')->checkRewardSlugEdit($data['slug'], $data['entityId']);

        if ($results->reward) {            
            $reward = $results->reward;
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
     * @Route("/LoyaltyReward/checkSku", name="LoyaltyRewardcheckSku")
     */
    public function checkSkuAction(Request $request)
    {
        $data = $request->get('LoyaltyReward');

        $newId = $data['sku'];

        $results = $this->get('rapp_loyalty.loyalty_service')->checkRewardSku($newId);

        if ($results->reward) {            
            $reward = $results->reward;
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
     * @Route("/LoyaltyReward/checkSkuEdit", name="LoyaltyRewardcheckSkuEdit")
     */
    public function checkSkuEditAction(Request $request)
    {
        $data = $request->get('LoyaltyReward');

        $results = $this->get('rapp_loyalty.loyalty_service')->checkRewardSkuEdit($data['sku'], $data['entityId']);

        if ($results->reward) {            
            $reward = $results->reward;
            $success = 0;
        } else {
            $success = 1;
        }

        $result = array('success' => $success);
        
        return new JsonResponse($result);
    }
}
