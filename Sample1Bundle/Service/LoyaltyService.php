<?php

namespace codewise\Bundle\LoyaltyBundle\Service;

use codewise\Bundle\LoyaltyBundle\Service\LoyaltyApiClient;
use Doctrine\ORM\EntityManager;
use JMS\Serializer\Serializer;
use Monolog\Logger;
use codewise\Bundle\DataBundle\Entity\IndividualPointAdd;
use codewise\Bundle\LoyaltyBundle\Model\Consumer;
use codewise\Bundle\LoyaltyBundle\Model\LoyaltyChallenge;
use codewise\Bundle\LoyaltyBundle\Model\LoyaltyOfferBundle;
use codewise\Bundle\LoyaltyBundle\Model\LoyaltyReward;

class LoyaltyService
{

    private $loyaltyApiClient;
    private $em;
    private $serializer;
    private $logger;

    public function __construct(LoyaltyApiClient $client, EntityManager $em, Serializer $serializer, Logger $logger)
    {
        $this->loyaltyApiClient = $client;
        $this->em = $em;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    public function getIndividual($codewiseMemberId)
    {
        $individual = $this->em->getRepository('codewiseDataBundle:Individual')->findOneBy(array(
            'codewiseMemberId' => $codewiseMemberId,
        ));

        return $individual;
    }

    public function addPoints($codewiseMemberId, $points, $notes, $user)
    {
        $response = $this->loyaltyApiClient->addPoints($codewiseMemberId, $points, $notes, $user->getId());

        if (!empty($response->success)) {
            try {
                $individual = $this->getIndividual($codewiseMemberId);

                $pointAdd = new IndividualPointAdd();

                $pointAdd->setUser($user);
                $pointAdd->setIndividual($individual);
                $pointAdd->setPoints($points);
                $pointAdd->setNotes($notes);

                $this->em->persist($pointAdd);
                $this->em->flush($pointAdd);

                return $points;
            } catch (\Exception $e) {
                $this->logger->log('error', "Failed to log $points points added to Loyalty Member [ID = $codewiseMemberId].");
                return -$points;
            }
        }

        return 0;
    }

    public function getConsumerDetails($codewiseMemberId)
    {
        $response = $this->loyaltyApiClient->getConsumerDetails($codewiseMemberId);

        if (isset($response->consumer)) {
            return $response->consumer;
        }
    }

    public function updateConsumer(Consumer $consumer)
    {
        $codewiseMemberId = $consumer->getcodewiseMemberId();
        $firstName = $consumer->getFirstName();
        $email = $consumer->getEmail();
        $phone = $consumer->getPhone();
        $storeCode = $consumer->getStoreCode();
        $birthMonth = $consumer->getBirthMonth();
        $birthDay = $consumer->getBirthDay();
        $plentiMemberID = $consumer->getPlentiMemberID();
        $plentiPhoneNumber = $consumer->getPlentiPhoneNumber();
        $plentiCardNumber = $consumer->getPlentiCardNumber();

        return $this->loyaltyApiClient->updateConsumer($codewiseMemberId, $firstName, $email, $phone, $storeCode, $birthMonth, $birthDay,
                $plentiMemberID, $plentiPhoneNumber, $plentiCardNumber);
    }

    public function getAvailableChallenges($activeStatus)
    {
        $data['active'] = $activeStatus;

        $json = $this->serializer->serialize($data, 'json');
        
        $results = $this->loyaltyApiClient->sendPostJsonRequest('getAvailableChallenges', $json);

        return $this->serializer->deserialize($results,'codewise\Bundle\LoyaltyBundle\Model\LoyaltyChallengesResponse', 'json');
    }

    public function getChallenge($id)
    {
        $data['id'] = $id;
        $json = $this->serializer->serialize($data, 'json');
        $results = $this->loyaltyApiClient->sendPostJsonRequest('getChallenge', $json);
        return $this->serializer->deserialize($results,'codewise\Bundle\LoyaltyBundle\Model\LoyaltyChallengeResponse', 'json');
    }

    public function createChallenge(LoyaltyChallenge $data)
    {
        $json = $this->serializer->serialize($data, 'json');
        
        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('createChallenge', $json));
    }

    public function updateChallenge($data, $id)
    {
        $result = $this->deleteChallenge($id);

        return $this->createChallenge($data);
    }

    public function deleteChallenge($id)
    {
        $data['id'] = $id;
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('deleteChallenge', $json));
    }

    public function activateChallenge($id)
    {
        $data['id'] = $id;
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('activateChallenge', $json));
    }

    public function checkChallengeCampaignId($id)
    {
        $data['id'] = $id;        
        $json = $this->serializer->serialize($data, 'json');
        
        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('checkChallengeCampaignId', $json));
    }

    public function checkChallengeSku($sku)
    {
        $data['sku'] = $sku;        
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('checkChallengeSku', $json));
    }

    public function checkChallengeSlug($slug)
    {
        $data['slug'] = $slug;        
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('checkChallengeSlug', $json));
    }

    public function checkChallengeCampaignIdEdit($campaignId, $id)
    {
        $data['campaignId'] = $campaignId;
        $data['id'] = $id;
   
        $json = $this->serializer->serialize($data, 'json');
        
        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('checkChallengeCampaignIdEdit', $json));
    }

    public function checkChallengeSkuEdit($sku, $id)
    {
        $data['sku'] = $sku;
        $data['id'] = $id;        
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('checkChallengeSkuEdit', $json));
    }

    public function checkChallengeSlugEdit($slug, $id)
    {
        $data['slug'] = $slug;
        $data['id'] = $id;       
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('checkChallengeSlugEdit', $json));
    }

    public function getChallengeRequirements()
    {
        $data['challengeRequirements'] = 'get';        
        $json = $this->serializer->serialize($data, 'json');
                
        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('getChallengeRequirements', $json));
    }

    public function getCheckCategories()
    {
        $data['checkCategory'] = 'all';        
        $json = $this->serializer->serialize($data, 'json');
                
        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('getCheckCategories', $json));
    }

    public function getChallengeCategories()
    {
        $data['getChallengeCategories'] = 'all';        
        $json = $this->serializer->serialize($data, 'json');
                
        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/getChallengeCategories', $json));
    }

    public function getAvailableOfferBundles($activeStatus)
    {
        $data['active'] = $activeStatus;

        $json = $this->serializer->serialize($data, 'json');
        
        $results = $this->loyaltyApiClient->sendPostJsonRequest('marvel/getOfferBundles/', $json);

        return $this->serializer->deserialize($results,'codewise\Bundle\LoyaltyBundle\Model\OfferBundlesResponse', 'json');
    }

    public function getOfferBundleTypes()
    {
        $data['getOfferBundleTypes'] = 'all';        
        $json = $this->serializer->serialize($data, 'json');
                
        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/getOfferBundleTypes/', $json));
    }

    public function createOfferBundle(LoyaltyOfferBundle $data)
    {
        $json = $this->serializer->serialize($data, 'json');
        
        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/createOfferBundle/', $json));
    }

    public function deleteOfferBundle($id)
    {
        $data['id'] = $id;
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/deleteOfferBundle/', $json));
    }

    public function activateOfferBundle($id)
    {
        $data['id'] = $id;
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/activateOfferBundle/', $json));
    }
    
    public function checkOfferBundleSlug($slug)
    {
        $data['slug'] = $slug;        
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/checkOfferBundleSlug/', $json));
    }

    public function checkOfferBundleSlugEdit($slug, $id)
    {
        $data['slug'] = $slug;
        $data['id'] = $id;       
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/checkOfferBundleSlugEdit/', $json));
    }

    public function getOfferBundle($id)
    {
        $data['id'] = $id;
        $json = $this->serializer->serialize($data, 'json');
        $results = $this->loyaltyApiClient->sendPostJsonRequest('marvel/getOfferBundle/', $json);
        return $this->serializer->deserialize($results,'codewise\Bundle\LoyaltyBundle\Model\LoyaltyOfferBundleResponse', 'json');
    }

    public function updateOfferBundle($data, $id)
    {
        $result = $this->deleteOfferBundle($id);

        return $this->createOfferBundle($data);
    }

    public function getRewards($getRewards)
    {
        $data['getRewards'] = $getRewards;        
        $json = $this->serializer->serialize($data, 'json');
                
        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/getRewards/', $json));
    }

    public function getReward($id)
    {
        $data['id'] = $id;
        $json = $this->serializer->serialize($data, 'json');
        $results = $this->loyaltyApiClient->sendPostJsonRequest('marvel/getReward/', $json);
        return $this->serializer->deserialize($results,'codewise\Bundle\LoyaltyBundle\Model\LoyaltyRewardResponse', 'json');
    }

    public function getRewardPrograms()
    {
        $data['getRewardPrograms'] = 'allActive';        
        $json = $this->serializer->serialize($data, 'json');
                
        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/getRewardPrograms/', $json));
    }

    public function createReward(LoyaltyReward $data)
    {
        $json = $this->serializer->serialize($data, 'json');
        
        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/createReward/', $json));
    }

    public function updateReward(LoyaltyReward $data)
    {
        $json = $this->serializer->serialize($data, 'json');
        
        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/updateReward/', $json));
    }

    public function deleteReward($id)
    {
        $data['id'] = $id;
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/deleteReward/', $json));
    }

    public function activateReward($id)
    {
        $data['id'] = $id;
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/activateReward/', $json));
    }
    
    public function checkRewardSlug($slug)
    {
        $data['slug'] = $slug;        
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/checkRewardSlug/', $json));
    }
    
    public function checkRewardSku($sku)
    {
        $data['sku'] = $sku;        
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/checkRewardSku/', $json));
    }

    public function checkRewardSlugEdit($slug, $id)
    {
        $data['slug'] = $slug;
        $data['id'] = $id;       
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/checkRewardSlugEdit/', $json));
    }

    public function checkRewardSkuEdit($sku, $id)
    {
        $data['sku'] = $sku;
        $data['id'] = $id;       
        $json = $this->serializer->serialize($data, 'json');

        return json_decode($this->loyaltyApiClient->sendPostJsonRequest('marvel/checkRewardSkuEdit/', $json));
    }
}
