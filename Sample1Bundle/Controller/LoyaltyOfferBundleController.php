<?php

namespace codewise\Bundle\LoyaltyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

use codewise\Bundle\LoyaltyBundle\Model\LoyaltyOfferBundle;
use codewise\Bundle\LoyaltyBundle\Form\LoyaltyOfferBundleType;
use codewise\Bundle\LoyaltyBundle\Model\LoyaltyOfferBundleItems;
/**
 * Loyalty OfferBundle controller.
 *
 * @Route("/LimitedTimeOffers")
 */
class LoyaltyOfferBundleController extends Controller
{

    /**
     * Lists available Offer Bundles.
     *
     * @Route("/LoyaltyOfferBundle/{status}", name="LoyaltyOfferBundles", defaults= {"status" = 0}, requirements = {"status"="3|2|1|0"})
     * @Template("codewiseLoyaltyBundle:LoyaltyOfferBundle:index.html.twig")
     */
    public function LoyaltyOfferBundleAction($status)
    {

        switch ($status) {
            case 1:
                $results = $this->get('codewise_loyalty.loyalty_service')->getAvailableOfferBundles('active');
                $status = 1;
                break;
            case 2:
                $results = $this->get('codewise_loyalty.loyalty_service')->getAvailableOfferBundles('archive');
                $status = 2;
                break;
            case 0:
            default:
                $results = $this->get('codewise_loyalty.loyalty_service')->getAvailableOfferBundles('draft');
                $status = 0;
                break;
        }

        if ($results->errorCode == '00000001') {
            $OfferBundles = $results->offerBundles;
            $error = 0;
        } else {
            $OfferBundles = array();
            $error = 1;
        }

        return array(
            'entities' => $OfferBundles,
            'status' => $status,
            'error' => $error
        );
    }

    /**
     * Render the Loyalty Offer Bundle form.
     *
     * @Route("/LoyaltyOfferBundle/create", name="LoyaltyOfferBundleCreate")
     * @Template("codewiseLoyaltyBundle:LoyaltyOfferBundle:create.html.twig")
     */
    public function LoyaltyOfferBundleCreateAction()
    {
        $request = $this->getRequest();

        $entity = New LoyaltyOfferBundle();

        $error = 0;

        $offerBundleTypes = $this->get('codewise_loyalty.loyalty_service')->getOfferBundleTypes();

        $offers = $this->getOffers();

        $createForm = $this->createCreateForm($entity, $offerBundleTypes->getOfferBundleTypes);

        $createForm->handleRequest($request);

        if ($createForm->isValid()) {
                $entity = $createForm->getData();
                
                $startDate = $entity->getStartDate();
                $startDate = $startDate->setTime(7, 0);

                $endDate = $entity->getEndDate();
                $endDate = $endDate->setTime(7, 0);

                $entity->setStartDate($startDate);
                $entity->setEndDate($endDate);

                $result = $this->get('codewise_loyalty.loyalty_service')->createOfferBundle($entity);
                
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
                            'error' => $error,
                            'challenges' => $offers->challenges,
                            'rewards' => $offers->rewards,
                            'offerBundles' => $offers->offerBundles,
                        );
                }
                
                return $this->redirect($this->generateUrl('LoyaltyOfferBundles'));
            }

        return array(
            'entity' => $entity,
            'form'   => $createForm->createView(),
            'error' => $error,
            'challenges' => $offers->challenges,
            'rewards' => $offers->rewards,
            'offerBundles' => $offers->offerBundles,
        );
    }

    /**
     * Creates a form to create a LoyaltyOfferBundle entity.
     *
     * @param LoyaltyOfferBundle $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(LoyaltyOfferBundle $entity, $bundleTypes)
    {
        $form = $this->createForm(new LoyaltyOfferBundleType($bundleTypes), $entity, array(
            'action' => $this->generateUrl('LoyaltyOfferBundleCreate'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to edit an existing Offer Bundle entity.
     *
     * @Route("/LoyaltyOfferBundle/{id}/edit", name="LoyaltyOfferBundleEdit")
     * @Template("codewiseLoyaltyBundle:LoyaltyOfferBundle:edit.html.twig")
     */
    public function editAction(Request $request, $id)
    {
        $error = 0;

        $results = $this->get('codewise_loyalty.loyalty_service')->getOfferBundle($id);
                
        $entity = $results->offerBundle;
               
        $offerBundleTypes = $this->get('codewise_loyalty.loyalty_service')->getOfferBundleTypes();

        $offers = $this->getOffers();
        
        $editForm = $this->createEditForm($entity, $offerBundleTypes->getOfferBundleTypes);

        $editForm->handleRequest($request);        

            if ($editForm->isValid()) {
                $entity = $editForm->getData();
                
                $startDate = $entity->getStartDate();
                $startDate = $startDate->setTime(7, 0);

                $endDate = $entity->getEndDate();
                $endDate = $endDate->setTime(7, 0);

                $entity->setStartDate($startDate);
                $entity->setEndDate($endDate);
                              
                $result = $this->get('codewise_loyalty.loyalty_service')->updateOfferBundle($entity, $id);

                if ($result->errorCode == '00000001') {
                    $error = 0;
                } else {
                    $error = 1;
                }
                
                return $this->redirect($this->generateUrl('LoyaltyOfferBundles'));
            }

            return array(
                'entity' => $entity,
                'form'   => $editForm->createView(),
                'error' => $error,
                'challenges' => $offers->challenges,
                'rewards' => $offers->rewards,
                'offerBundles' => $offers->offerBundles,
            );
    }

    /**
    * Creates a form to edit a LoyaltyOfferBundle entity.
    *
    * @param LoyaltyOfferBundle $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(LoyaltyOfferBundle  $entity, $bundleTypes)
    {
        $form = $this->createForm(new LoyaltyOfferBundleType($bundleTypes), $entity, array(
            'action' => $this->generateUrl('LoyaltyOfferBundleEdit', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Deletes existing Offer Bundle entity.
     *
     * @Route("/LoyaltyOfferBundle/{id}/delete", name="LoyaltyOfferBundleDelete")
     * @Template("codewiseLoyaltyBundle:LoyaltyOfferBundle:index.html.twig")
     */
    public function deleteAction(Request $request, $id)
    {
        $result = $this->get('codewise_loyalty.loyalty_service')->deleteOfferBundle($id);
                
        return $this->redirect($this->generateUrl('LoyaltyOfferBundles'));
    }

    /**
     * Activates existing Offer Bundle entity.
     *
     * @Route("/LoyaltyOfferBundle/{id}/activate", name="LoyaltyOfferBundleActivate")
     * @Template("codewiseLoyaltyBundle:LoyaltyOfferBundle:index.html.twig")
     */
    public function activateAction(Request $request, $id)
    {
        $result = $this->get('codewise_loyalty.loyalty_service')->activateOfferBundle($id);
                
        return $this->redirect($this->generateUrl('LoyaltyOfferBundles'));
    }

    /**
     * Get Offer Bundle entity.
     *
     * @Route("/LoyaltyOfferBundle/{id}/view", name="LoyaltyOfferBundleView")
     * @Template("codewiseLoyaltyBundle:LoyaltyOfferBundle:view.html.twig")
     */
    public function LoyaltyOfferBundleViewAction(Request $request, $id)
    {
        $results = $this->get('codewise_loyalty.loyalty_service')->getOfferBundle($id);
                
        $entity = $results->offerBundle;

        return array('entity' => $entity);
    }

    /**
     * Ajax route to check Unique Slug.
     *
     * @Route("/LoyaltyOfferBundle/checkSlug", name="LoyaltyOfferBundlecheckSlug")
     */
    public function checkSlugAction(Request $request)
    {
        $data = $request->get('LoyaltyOfferBundle');

        $newId = $data['desc'];

        $results = $this->get('codewise_loyalty.loyalty_service')->checkOfferBundleSlug($newId);

        if ($results->offerBundle) {            
            $offerBundle = $results->offerBundle;
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
     * @Route("/LoyaltyOfferBundle/checkSlugEdit", name="LoyaltyOfferBundlecheckSlugEdit")
     */
    public function checkSlugEditAction(Request $request)
    {
        $data = $request->get('LoyaltyOfferBundle');

        $results = $this->get('codewise_loyalty.loyalty_service')->checkOfferBundleSlugEdit($data['desc'], $data['entityId']);

        if ($results->offerBundle) {            
            $offerBundle = $results->offerBundle;
            $success = 0;
        } else {
            $success = 1;
        }

        $result = array('success' => $success);
        
        return new JsonResponse($result);
    }

    /**
     * Get Offers for select drop downs.
     *
     */
    private function getOffers()
    {
        $offers = new \stdClass();
        $challenges = $rewards = $offerBundles = [];

        $results = $this->get('codewise_loyalty.loyalty_service')->getAvailableChallenges('bundles');                
        if ($results->errorCode == '00000001') {
            foreach ($results->challenges as $value) {
                $challenges[intval($value->getId())] = $value->getId().' - '.$value->getName();
            }
        }

        $results = $this->get('codewise_loyalty.loyalty_service')->getRewards('bundles');
        if ($results->errorCode == '00000001') {
            foreach ($results->getRewards as $value) {
                $rewards[intval($value->id)] = $value->id.' - '.$value->name;
            }
        }

        $results = $this->get('codewise_loyalty.loyalty_service')->getAvailableOfferBundles('bundles');
        if ($results->errorCode == '00000001') {
            foreach ($results->offerBundles as $value) {
                $offerBundles[intval($value->getId())] = $value->getId().' - '.$value->getName();
            }
        }

        $offers->challenges = $challenges;
        $offers->rewards = $rewards;
        $offers->offerBundles = $offerBundles;

        return $offers;
    }
}
