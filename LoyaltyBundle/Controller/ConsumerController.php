<?php

namespace RAPP\Bundle\LoyaltyBundle\Controller;

use Monolog\Logger;
use RAPP\Bundle\LoyaltyBundle\Form\ChangePasswordType;
use RAPP\Bundle\LoyaltyBundle\Form\ChangePinType;
use RAPP\Bundle\LoyaltyBundle\Model\ChangePassword;
use RAPP\Bundle\LoyaltyBundle\Model\ChangePin;
use RAPP\Bundle\DataBundle\Entity\IndividualPointAdd;
use RAPP\Bundle\LoyaltyBundle\Form\MessageType;
use RAPP\Bundle\LoyaltyBundle\Form\PointAdjustmentType;
use RAPP\Bundle\LoyaltyBundle\Form\PointRequestType;
use RAPP\Bundle\LoyaltyBundle\Form\AddRewardType;
use RAPP\Bundle\LoyaltyBundle\Model\Message;
use RAPP\Bundle\LoyaltyBundle\Model\PointAdjustment;
use RAPP\Bundle\LoyaltyBundle\Model\PointRequest;
use RAPP\Bundle\LoyaltyBundle\Model\AddReward;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/consumer/{brinkerMemberId}")
 */
class ConsumerController extends Controller
{
    /** @var Logger */
    private $logger;
    
    private function getLogger()
    {
        if (!$this->logger instanceof Logger) {
            $this->logger = $this->get('logger');
        }
    
        return $this->logger;
    }
    
    /**
     * @Route("/overview", name="rapp_loyalty_consumer_overview")
     */
    public function overview($brinkerMemberId)
    {
        $i=-1;
        $individualAttributes = array();
        $consumer = $this->get('rapp_loyalty.loyalty_api_client')->getConsumerDetails($brinkerMemberId);
        $em = $this->getDoctrine()->getManager();
        $individual = $em->getRepository('RAPPDataBundle:Individual')->findOneBy(array('brinkerMemberId' => $brinkerMemberId));

        $repository = $em->getRepository('RAPPDataBundle:IndividualAttribute');
        $individualAttribute = $repository->findBy(['individual'=>$individual]);

        $repository = $em->getRepository('RAPPDataBundle:IndividualExternalId');
        $individualExternalId = $repository->findBy(['individual'=>$individual]);
        foreach ($individualExternalId as $att){
            if($att->getName() == 'plenti_member_id' && $att->getActive() == 1){
                $created = (array) $att->getCreatedTs();
                $individualAttributes['created']= date("Y-m-d", strtotime($created['date']));
                $plentiMemberId = $att->getValue();
            }
        };

        if(!empty($plentiMemberId)){
            $individualAttributes['member_type']="MCA & Plenti" ;
        } else {
            $individualAttributes['member_type']="MCA";
        };

        foreach ($individualAttribute as $att){

            $i++;

            if($att->getName() == 'plenti_email') {

                $individualAttributes[$att->getName()]= $att->getValue();

            } elseif ($att->getName() == 'share_plenti_data') {

                if($att->getValue() == '1'){
                    $individualAttributes[$att->getName()]= 'granted';
                } elseif($att->getValue() == '2') {
                    $individualAttributes[$att->getName()]= 'revoked';
                } else {
                    $individualAttributes[$att->getName()]= 'unknown';
                }

            } else {

                $individualAttributes[$att->getName()]= $att->getValue();
            }
        };

        return $this->render('RAPPLoyaltyBundle:Consumer:overview.html.twig', array('consumer' => $consumer, 'individualAttribute' => $individualAttributes, 'showPlenti' => 0));
    }

    /**
     * @Route("/activities", name="rapp_loyalty_consumer_activities")
     */
    public function activities($brinkerMemberId)
    {
        $loyaltyApiClient = $this->get('rapp_loyalty.loyalty_api_client');

        $activities = $loyaltyApiClient->getConsumerActivities($brinkerMemberId);

        return $this->render('RAPPLoyaltyBundle:Consumer:activities.html.twig', array('activities' => $activities));
    }

    /**
     * @Route("/pointAdjustments", name="rapp_loyalty_consumer_point_adjustments")
     */
    public function pointAdjustments($brinkerMemberId)
    {
        $em = $this->getDoctrine()->getManager();

        $pointAdjustments = $em->getRepository('RAPPDataBundle:IndividualPointAdd')->getByBrinkerMemberId($brinkerMemberId);

        return $this->render('RAPPLoyaltyBundle:Consumer:pointAdjustments.html.twig', array('pointAdjustments' => $pointAdjustments));
    }

    /**
     * @Route("/pointRequests", name="rapp_loyalty_consumer_point_requests")
     */
    public function pointRequests($brinkerMemberId)
    {
        $pointRequests = $this->get('rapp_loyalty.loyalty_api_client')->getPointRequests($brinkerMemberId);

        return $this->render('RAPPLoyaltyBundle:Consumer:pointRequests.html.twig', array('pointRequests' => $pointRequests));
    }

    /**
     * @Route("/adjustPoints", name="rapp_loyalty_consumer_adjust_points")
     * @Method({"GET"})
     */
    public function adjustPointsGet()
    {
        $pointAdjustment = new PointAdjustment();

        $form = $this->createForm(new PointAdjustmentType(), $pointAdjustment);

        return $this->render('RAPPLoyaltyBundle:Consumer:adjustPoints.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/adjustPoints")
     * @Method({"POST"})
     */
    public function adjustPointsPost(Request $request, $brinkerMemberId)
    {
        $form = $this->createForm(new PointAdjustmentType());

        $form->handleRequest($request);

        if ($form->isValid()) {

            $user = $this->getUser();

            $pointAdjustment = $form->getData();

            $pointAdjustment->setBrinkerMemberId($brinkerMemberId);
            $pointAdjustment->setUser($user->getId());

            try {
                $pointsAdded = $this->get('rapp_loyalty.loyalty_api_client')->adjustPoints($pointAdjustment);

                if ($pointsAdded) {

                    $em = $this->getDoctrine()->getManager();

                    $individual = $em->getRepository('RAPPDataBundle:Individual')->findOneBy(array(
                        'brinkerMemberId' => $brinkerMemberId,
                    ));

                    $pointAdd = new IndividualPointAdd();

                    $pointAdd->setUser($user);
                    $pointAdd->setIndividual($individual);
                    $pointAdd->setPoints($pointAdjustment->getPoints());
                    $pointAdd->setNotes($pointAdjustment->getNotes());

                    $em->persist($pointAdd);
                    $em->flush($pointAdd);

                    $response = array(
                        'success' => true,
                        'pointsAdded' => $pointsAdded,
                        'errorMessage' => 'Point Adjustment Successful',
                    );
                } else {
                    $response = array(
                        'success' => false,
                        'errorMessage' => 'Point Adjustment Failed',
                    );
                }
            } catch (\Exception $e) {
                $response = array(
                    'success' => false,
                    'errorMessage' => 'Point Adjustment Failed',
                );
            }
        } else {
            $response = array(
                'success' => false,
                'errorMessage' => 'Invalid Request',
            );
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/requestPoints", name="rapp_loyalty_consumer_request_points")
     * @Method({"GET"})
     */
    public function requestPointsGet($brinkerMemberId)
    {
        $pointRequest = new PointRequest();
        $pointRequest->setBrinkerMemberId($brinkerMemberId);

        $form = $this->createForm(new PointRequestType(), $pointRequest);

        return $this->render('RAPPLoyaltyBundle:Consumer:requestPoints.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/requestPoints")
     * @Method({"POST"})
     */
    public function requestPointsPost(Request $request, $brinkerMemberId)
    {
        $loyaltyApiClient = $this->get('rapp_loyalty.loyalty_api_client');

        $form = $this->createForm(new PointRequestType());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $pointRequest = $form->getData();
            try {
                $success = $loyaltyApiClient->requestPoints($pointRequest);
                if ($success === true) {
                    $response = array(
                        'success' => true,
                        'errorMessage' => 'Manual Point Request Submitted',
                    );
                } else {
                    $response = array(
                        'success' => false,
                        'errorMessage' => 'Manual Point Request Failed',
                    );
                }
            } catch (\Exception $e) {
                $response = array(
                    'success' => false,
                    'errorMessage' => 'Manual Point Request Failed',
                );
            }
        } else {
            $response = array(
                'success' => false,
                'errorMessage' => 'Invalid Request',
            );
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/sendMessage", name="rapp_loyalty_consumer_send_message")
     * @Method({"GET"})
     */
    public function sendMessageGet()
    {
        $form = $this->createForm(new MessageType());

        return $this->render('RAPPLoyaltyBundle:Consumer:sendMessage.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/sendMessage")
     * @Method({"POST"})
     */
    public function sendMessagePost(Request $request, $brinkerMemberId)
    {
        $form = $this->createForm(new MessageType());

        $form->handleRequest($request);

        if ($form->isValid()) {

            $message = $form->getData();

            $message->setBrinkerMemberId($brinkerMemberId);

            $loyaltyApiClient = $this->get('rapp_loyalty.loyalty_api_client');

            $response = $loyaltyApiClient->sendMessage($message);

            if ($response->success) {
                $response = array(
                    'success' => true,
                    'errorMessage' => 'Message successfully sent!',
                );
            } else {
                $response = array(
                    'success' => false,
                    'errorMessage' => 'Failed to send message!',
                );
            }
        } else {
            $response = array(
                'success' => false,
                'errorMessage' => 'Invalid Request',
            );
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/visits", name="rapp_loyalty_consumer_visits")
     */
    public function visits($brinkerMemberId)
    {
        $loyaltyApiClient = $this->get('rapp_loyalty.loyalty_api_client');

        $visits = $loyaltyApiClient->getConsumerVisits($brinkerMemberId);

        return $this->render('RAPPLoyaltyBundle:Consumer:visits.html.twig', array('visits' => $visits));
    }

    /**
     * @Route("/updateStatus", name="rapp_loyalty_consumer_update_status")
     * @Method({"GET"})
     */
    public function updateStatusGet()
    {
        $form = $this->createFormBuilder()
                ->add('status', 'choice', array(
                    'choices' => array(
                        'normal' => 'normal',
                        'blacklist' => 'blacklist',
                        'whitelist' => 'whitelist',
                    ),
                ))
                ->add('active', 'choice', array(
                    'choices' => array(
                        1 => 'active',
                        0 => 'inactive',
                    ),
                    'required' => false
                ))
                ->add('notes', 'textarea', array(
                    'required' => false
                    ))
                ->getForm();

        return $this->render('RAPPLoyaltyBundle:Consumer:updateStatus.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/updateStatus")
     * @Method({"POST"})
     */
    public function updateStatusPost(Request $request, $brinkerMemberId)
    {
        $form = $this->createFormBuilder()
                ->add('status', 'choice', array(
                    'choices' => array(
                        'normal' => 'normal',
                        'blacklist' => 'blacklist',
                        'whitelist' => 'whitelist',
                    ),
                ))
                ->add('active', 'choice', array(
                    'choices' => array(
                        1 => 'active',
                        0 => 'inactive',
                    ),
                    'required' => false
                ))
                ->add('notes', 'textarea', array(
                    'required' => false
                    ))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $status = $form->get('status')->getData();
            $active = $form->get('active')->getData();
            $note = $form->get('notes')->getData();

            $loyaltyApiClient = $this->get('rapp_loyalty.loyalty_api_client');

            $success = $loyaltyApiClient->updateConsumerStatus($brinkerMemberId, $status, $active);

            if ($success) {
                //opt out for inactive/blacklist
                $optOut = $status == 'blacklist' || $active === 0;
                
                $activeStr = is_null($active)? '' : ($active? 'active' : 'inactive');
                $notes = $this->addNotes($brinkerMemberId, $note, 'CHANGE MEMBER STATUS: ('. $status. ($activeStr? '/'.$activeStr : '') . ') ', $optOut);
                
                $response = array(
                    'success' => true,
                    'status' => $status,
                    'active' => $activeStr,
                    'errorMessage' => 'Consumer status successfully updated!',
                    'notes' => $notes
                );
            } else {
                $response = array(
                    'success' => false,
                    'errorMessage' => 'Failed to update consumer status!',
                );
            }
        } else {
            $response = array(
                'success' => false,
                'errorMessage' => 'Invalid Request',
            );
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/challenges", name="rapp_loyalty_consumer_challenges")
     */
    public function getChallenges($brinkerMemberId)
    {
        $challenges = $this->get('rapp_loyalty.loyalty_api_client')->getConsumerChallenges($brinkerMemberId);
  
        return $this->render('RAPPLoyaltyBundle:Consumer:challenges.html.twig', array('challenges' => $challenges));
    }

    /**
     * @Route("/rewards", name="rapp_loyalty_consumer_rewards")
     */
    public function getRewards($brinkerMemberId)
    {
        $rewards = $this->get('rapp_loyalty.loyalty_api_client')->getConsumerRewards($brinkerMemberId);

        return $this->render('RAPPLoyaltyBundle:Consumer:rewards.html.twig', array('rewards' => $rewards));
    }

    /**
     * @Route("/offers/{status}", name="rapp_loyalty_consumer_offers", defaults = {"status" = 1 })
     */
    public function getOffers($brinkerMemberId, $status)
    {
        if ($status == 0) {
            $offers = $this->get('rapp_loyalty.loyalty_api_client')->getConsumerOffers($brinkerMemberId , 'Active');
            $status = 0;
        } else {
            $offers = $this->get('rapp_loyalty.loyalty_api_client')->getConsumerOffers($brinkerMemberId , 'Expired');
            $status = 1;
        }

        return $this->render('RAPPLoyaltyBundle:Consumer:offers.html.twig', array('offers' => $offers, 'status' => $status));

    }

    /**
     * @Route("/changePin", name="rapp_loyalty_change_pin")
     * @Method({"GET"})
     */
    public function changePinGet($brinkerMemberId)
    {
        $changePin = new ChangePin();
        $changePin->setBrinkerMemberId($brinkerMemberId);

        $form = $this->createForm(new ChangePinType(), $changePin);

        return $this->render('RAPPLoyaltyBundle:Consumer:changePin.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/changePin")
     * @Method({"POST"})
     */
    public function changePinPost(Request $request, $brinkerMemberId)
    {
        $loyaltyApiClient = $this->get('rapp_loyalty.loyalty_api_client');

        $form = $this->createForm(new ChangePinType());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $changePin = $form->getData();
            
            try {
                $success = $loyaltyApiClient->changePin($changePin);
                if ($success === true) {
                    $notes = $this->addNotes($brinkerMemberId, $changePin->getNotes(), 'CHANGE PIN: ');
                    
                    $response = array(
                        'success' => true,
                        'errorMessage' => 'Change PIN Successful',
                        'notes' => $notes
                    );
                } else {
                    $response = array(
                        'success' => false,
                        'errorMessage' => 'Change PIN Failed',
                    );
                }
            } catch (\Exception $e) {
                $response = array(
                    'success' => false,
                    'errorMessage' => 'Change PIN Error'.$e->getMessage(),
                );
            }
        } else {
            $errors = array();
            foreach ($form as $field) {
                if (!empty($field->getErrorsAsString())) {
                    $errors[$field->getName()] = $field->getErrorsAsString();
                }
            }
            
            $response = array(
                'success' => false,
                'errorMessage' => 'Invalid Request',
                'errors' => $errors
            );
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/changePassword", name="rapp_loyalty_change_password")
     * @Method({"GET"})
     */
    public function changePassword($brinkerMemberId)
    {
        $changePassword = new ChangePassword();
        $changePassword->setBrinkerMemberId($brinkerMemberId);

        $form = $this->createForm(new ChangePasswordType(), $changePassword);

        return $this->render('RAPPLoyaltyBundle:Consumer:changePassword.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/changePassword")
     * @Method({"POST"})
     */
    public function changePasswordPost(Request $request, $brinkerMemberId)
    {
        $loyaltyApiClient = $this->get('rapp_loyalty.loyalty_api_client');

        $form = $this->createForm(new ChangePasswordType());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $changePassword = $form->getData();
            
            try {
                $success = $loyaltyApiClient->changePassword($changePassword);
                if ($success === true) {
                    $notes = $this->addNotes($brinkerMemberId, $changePassword->getNotes(), 'CHANGE PASSWORD: ');
                    
                    $response = array(
                        'success' => true,
                        'errorMessage' => 'Change Password Successful',
                        'notes' => $notes
                    );
                } else {
                    $response = array(
                        'success' => false,
                        'errorMessage' => 'Change Password Failed',
                    );
                }
            } catch (\Exception $e) {
                $response = array(
                    'success' => false,
                    'errorMessage' => 'Change Password Error',
                );
            }
        } else {
            $errors = array();
            foreach ($form as $field) {
                if (!empty($field->getErrorsAsString())) {
                    $errors[$field->getName()] = $field->getErrorsAsString();
                }
            }
            
            $response = array(
                'success' => false,
                'errorMessage' => 'Invalid Request',
                'errors' => $errors
            );
        }

        return new JsonResponse($response);
    }

    private function addNotes($brinkerMemberId, $notes, $prefix = '', $optOut = false)
    {
        $divisionNo = 1;
        $drm = $this->container->get('rapp_data.repository_manager');
        $individual = $drm->getIndividualByBrinkerMemberID($brinkerMemberId);

        $user = $this->getUser();
        $iNotes = new \RAPP\Bundle\DataBundle\Entity\IndividualNotes();
        $iNotes->setDivisionNo($divisionNo);
        $iNotes->setUser($user);
        $iNotes->setIndividual($individual);
        $iNotes->setNotes($prefix . $notes);

        $drm->addIndividualNotes($iNotes);

        if ($optOut) {
            $drm->unsubIndividual($divisionNo, $individual);
            
            $etSqsService = $this->container->get('et_queue_service');
            $etSqsService->upsertSubscriber($divisionNo, $individual, true);
            $etSqsService->upsertMaster($divisionNo, $individual);
        }
        
        $timezone = $this->container->getParameter('dashboard.timezone');
        $createDt = $iNotes->getCreatedTs();
        $createDt->setTimezone(new \DateTimeZone($timezone));

        return array(
                'username' => $iNotes->getUser()->getUsername(),
                'date' => $createDt->format('M j, Y'),
                'time' => $createDt->format('h:iA'),
                'notes' => $iNotes->getNotes()
            );
    }

    /**
     * @Route("/addReward", name="rapp_loyalty_consumer_add_reward")
     * @Method({"GET"})
     */
    public function addRewardGet()
    {

        $rewards = $this->get('rapp_loyalty.loyalty_service')->getRewards('allClaimable');

        $addReward = new AddReward();

        $form = $this->createForm(new AddRewardType($rewards->getRewards), $addReward);

        return $this->render('RAPPLoyaltyBundle:Consumer:addReward.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/addReward")
     * @Method({"POST"})
     */
    public function addRewardPost(Request $request, $brinkerMemberId)
    {
        $rewards = $this->get('rapp_loyalty.loyalty_service')->getRewards('allClaimable');

        $form = $this->createForm(new AddRewardType($rewards->getRewards));

        $form->handleRequest($request);

        if ($form->isValid()) {

            $user = $this->getUser();

            $addReward = $form->getData();

            $addReward->setBrinkerMemberId($brinkerMemberId);
            $addReward->setUser($user->getId());

            try {

                $rewardAdded = $this->get('rapp_loyalty.loyalty_api_client')->addReward($addReward);

                if ($rewardAdded->success) {

                    $response = array(
                        'success' => true,
                        'rewardAdded' => $rewardAdded,
                        'errorMessage' => 'Reward Added Successfully',

                    );
                } else {
                    $response = array(
                        'success' => false,
                        'errorMessage' => 'Reward Add Failed',
                    );
                }
            } catch (\Exception $e) {
                $this->getLogger()->error('Error adding reward in LMS'
                        . ' for BMID ' . $brinkerMemberId
                        . ' with exception: ' . (string) $e);
                $response = array(
                    'success' => false,
                    'errorMessage' => 'Reward Add Failed',
                );
            }
        } else {
            $response = array(
                'success' => false,
                'errorMessage' => 'Invalid Request',
            );
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/rewardAdjustments", name="rapp_loyalty_consumer_reward_adjustments")
     */
    public function rewardAdjustments($brinkerMemberId)
    {
        $em = $this->getDoctrine()->getManager();

        $rewardAdjustments = $this->get('rapp_loyalty.loyalty_api_client')->getRewardAdjustments($brinkerMemberId);

        for ($i=0; $i <count($rewardAdjustments) ; $i++) { 
            $rewardAdjustment = $rewardAdjustments[$i];
            $user = $em->getRepository('RAPPMarvelAdminBundle:User')->find($rewardAdjustment->user);
            $rewardAdjustments[$i]->username = $user->getUsername();
        }

        return $this->render('RAPPLoyaltyBundle:Consumer:rewardAdjustments.html.twig', array('rewardAdjustments' => $rewardAdjustments));
    }

}
