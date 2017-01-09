<?php

namespace codewise\Bundle\LoyaltyBundle\Service;

use CommerceGuys\Guzzle\Plugin\Oauth2\Oauth2Plugin;
use CommerceGuys\Guzzle\Plugin\Oauth2\GrantType\ClientCredentials;
use Guzzle\Common\Exception\GuzzleException;
use Guzzle\Http\Client;
use JMS\Serializer\Serializer;
use Monolog\Logger;
use codewise\Bundle\LoyaltyBundle\Model\Consumer;
use codewise\Bundle\LoyaltyBundle\Model\Message;
use codewise\Bundle\LoyaltyBundle\Model\PointAdjustment;
use codewise\Bundle\LoyaltyBundle\Model\PointRequest;
use codewise\Bundle\LoyaltyBundle\Model\ChangePin;
use codewise\Bundle\LoyaltyBundle\Model\ChangePassword;
use codewise\Bundle\LoyaltyBundle\Model\AddReward;

class LoyaltyApiClient
{

    /** @var Client */
    private $api;

    /** @var Serializer */
    private $serializer;

    /** @var Logger */
    private $logger;

    /** @var boolean */
    const IS_ALPHA = true;

    public function __construct($apiUrl, $oAuthUrl, $oAuthClientId, $oAuthClientSecret, Serializer $serializer, Logger $logger)
    {
        $this->serializer = $serializer;
        $this->logger = $logger;

        $oauthClient = new Client($oAuthUrl);

        $oAuthConfig = array(
            'client_id' => $oAuthClientId,
            'client_secret' => $oAuthClientSecret,
        );

        $grantType = new ClientCredentials($oauthClient, $oAuthConfig);
        $oauth2Plugin = new Oauth2Plugin($grantType);

        $this->api = new Client($apiUrl);
        $this->api->addSubscriber($oauth2Plugin);
    }

    public function sendPostRequest($path, $data)
    {
        $result = new \stdClass();
        $result->success = false;
        $jsonResult = $this->sendPostJsonRequest($path, json_encode($data));
        $result = json_decode($jsonResult);
        $result->success = isset($result->errorCode) && $result->errorCode === '00000001';
        return $result;
    }
    
    public function sendPostJsonRequest($path, $json)
    {
        try {
            $request = $this->api->post($path, array(), $json);
            $response = $request->send();
            $result = $response->getBody(1);
        } catch (GuzzleException $e) {
            $url = empty($request) ? '' : $request->getUrl();
            $errorMessage = $e->getMessage();
            $this->logger->error("Guzzle POST Request Failure (URL = '$url'):  $errorMessage");
        } catch (\Exception $e) {
            $url = empty($request) ? '' : $request->getUrl();
            $errorMessage = $e->getMessage();
            $this->logger->error("Loyalty POST Request Failure (URL = '$url'):  $errorMessage");
        }
        return $result;
    }

    public function createAccount($record)
    {

        $account = array();

        if (self::IS_ALPHA) {
            //create password
            //create pin
            $password = substr(preg_replace('/[^0-9]/', '', $record['MobilePhone']), -10);
            $account['password'] = $password;
            $account['pin'] = substr($password, -4);
        }

        $account['email'] = $record['Email'];
        $account['firstName'] = $record['FirstName'];
        $account['lastName'] = $record['LastName'];
        $account['dob'] = '1904-' . $record['BirthDate']['Month'] . '-' . $record['BirthDate']['Day'];
        $account['zipcode'] = $record['Zip'];
        $account['over18'] = $record['Over18'];
        $account['phone'] = substr(preg_replace('/[^0-9]/', '', $record['MobilePhone']), -10);
        $account['mobileOptIn'] = $record['MobileOptIn'];
        $account['store'] = $record['Preferences'][1]['StoreCode'];

        $request = $this->api->post('register/', null, json_encode($account));

        $result = $this->api->send($request);

        $result = json_decode($result->getBody(1));
        if ($result->errorCode != '00000001') {
            throw new \Exception('Loyalty Error', $result->errorCode);
        }
        return $result;
    }

    public function updateAccount($record)
    {
        $account = array();

        $account['loyaltyID'] = $record['codewiseMemberID'];
        $account['email'] = $record['Email'];
        $account['firstName'] = $record['FirstName'];
        $account['lastName'] = $record['LastName'];
        $account['birthDate'] = '1904-' . $record['BirthDate']['Month'] . '-' . $record['BirthDate']['Day'];
        $account['zip'] = $record['Zip'];
        $account['over18'] = $record['Over18'];
        $account['phone'] = substr(preg_replace('/[^0-9]/', '', $record['MobilePhone']), -10);
        $account['mobileOptIn'] = $record['MobileOptIn'];
        $account['store'] = $record['Preferences'][1]['StoreCode'];

        $request = $this->api->post('updateConsumer/', null, json_encode($account));

        $result = $this->api->send($request);

        $result = json_decode($result->getBody(1));
        if ($result->errorCode != '00000001') {
            throw new \Exception('Loyalty Error', $result->errorCode);
        }
        return $result;
    }

    public function getConsumerDetails($codewiseMemberId)
    {
        $data = array(
            'loyaltyID' => $codewiseMemberId,
        );
        $response = $this->sendPostRequest('getConsumerDetails/', $data);
        if (!isset($response->consumer)) {
            return null;
        }

        $consumerDetails = $response->consumer;

        $consumer = new Consumer();

        $consumer->setcodewiseMemberId($consumerDetails->codewiseMemberId);
        $consumer->setActive($consumerDetails->active);
        $consumer->setStatus($consumerDetails->status);
        $consumer->setBasePoints($consumerDetails->basePoints);
        $consumer->setLtoPoints($consumerDetails->ltoPoints);
        $consumer->setTotalPoints($consumerDetails->totalPoints);
        $consumer->setEnrollDate($consumerDetails->enrollDate);
        $consumer->setPointsExpirationDate($consumerDetails->pointsExpirationDate);
        $consumer->setPlatinumStatus($consumerDetails->platinumStatus);
        $consumer->setPlentiCardNumber($consumerDetails->plentiCardNumber);
        $consumer->setPlentiPhoneNumber($consumerDetails->plentiPhoneNumber);
        $consumer->setPlentiMemberID($consumerDetails->plentiMemberID);


        return $consumer;
    }

    public function getConsumerActivities($codewiseMemberId)
    {
        $data = array(
            'loyaltyID' => $codewiseMemberId,
        );

        $response = $this->sendPostRequest('getConsumerActivities/', $data);

        if (isset($response->activities)) {
            usort($response->activities, function($a, $b) {
                return $a->createDate < $b->createDate;
            });
            return $response->activities;
        }

        return array();
    }

    public function getConsumerVisits($codewiseMemberId)
    {
        $data = array(
            'loyaltyID' => $codewiseMemberId,
        );

        $response = $this->sendPostRequest('getConsumerVisits/', $data);

        if (isset($response->visits)) {
            return $response->visits;
        }

        return array();
    }

    public function sendMessage(Message $message)
    {
        $data = array(
            'messageType' => $message->getType(),
            'codewiseMemberId' => $message->getcodewiseMemberId(),
        );

        return $this->sendPostRequest('sendMessage/', $data);
    }

    public function adjustPoints(PointAdjustment $pointAdjustment)
    {
        $response = $this->sendPostRequest('addPoints/', $pointAdjustment->jsonSerialize());

        if (isset($response->points)) {
            return $response->points;
        }
    }

    public function updateConsumer($codewiseMemberId, $firstName, $email, $phone, $storeCode, $birthMonth, $birthDay,
                $plentiMemberID, $plentiPhoneNumber, $plentiCardNumber)
    {
        $data = array(
            'loyaltyID' => $codewiseMemberId,
            'firstName' => $firstName,
            'email' => $email,
            'phone' => $phone,
            'storeCode' => $storeCode,
            'birthMonth' => $birthMonth,
            'birthDay' => $birthDay,
            'plentiMemberID' => $plentiMemberID,
            'plentiPhoneNumber' => $plentiPhoneNumber,
            'plentiCardNumber' => $plentiCardNumber
        );

        $response = $this->sendPostRequest('marvel/updateConsumer/', $data);

        if ($response->errorCode == '00000001') {
            return true;
        }
        else {
            $this->logger->log('error', "Marvel/updateConsumer error=".$response->errorCode.":".$response->errorMessage.", data=". json_encode($data));
            return $response->errorMessage;
        }
    }

    public function requestPoints(PointRequest $pointRequest)
    {
        $response = $this->sendPostRequest('requestManualPoints/', $pointRequest->jsonSerialize());

        if (isset($response->errorCode) && $response->errorCode == '00000001') {
            return true;
        }

        return false;
    }

    public function getPointRequests($codewiseMemberId)
    {
        $data = array(
            'loyaltyID' => $codewiseMemberId,
        );

        $response = $this->sendPostRequest('getPointRequestHistory/', $data);

        if (isset($response->pointRequests)) {
            return $response->pointRequests;
        }

        return array();
    }

    public function updateConsumerStatus($codewiseMemberId, $status, $active)
    {
        $data = array(
            'loyaltyID' => $codewiseMemberId,
            'status' => $status
        );

        if (!is_null($active)) {
            $data['active'] = boolval($active);
        }
        
        $response = $this->sendPostRequest('updateConsumerStatus/', $data);

        if (isset($response->errorCode) && $response->errorCode == '00000001') {
            return true;
        }

        return false;
    }

    public function getConsumerChallenges($codewiseMemberId)
    {
        $data = array(
            'loyaltyID' => $codewiseMemberId,
        );

        $response = $this->sendPostRequest('marvel/getChallenges/', $data);

        if (isset($response->challenges)) {
            return $response->challenges;
        }
        
        return false;
    }

    public function getConsumerRewards($codewiseMemberId)
    {
        $data = array(
            'loyaltyID' => $codewiseMemberId,
        );

        $response = $this->sendPostRequest('marvel/getConsumerRewards/', $data);

        if (isset($response->rewards)) {
            return $response->rewards;
        }
        
        return false;
    }

    public function getConsumerOffers($codewiseMemberId, $status)
    {
        $data = array(
            'loyaltyID' => $codewiseMemberId,
            'status' => $status,
        );

        $response = $this->sendPostRequest('marvel/getConsumerOffers/', $data);

        if (isset($response->offers)) {
            return $response->offers;
        }
        
        return false;
    }

    public function getConsumerClaimedOffers($codewiseMemberId)
    {
        $data = array(
            'loyaltyID' => $codewiseMemberId,
        );

        $response = $this->sendPostRequest('claimedOffers/', $data);

        if (isset($response->offers)) {
            return $response->offers;
        }
        
        return false;
    }

    public function changePin(ChangePin $changePin)
    {
        $response = $this->sendPostRequest('changePincodewise/', $changePin->jsonSerialize());
        
        if (isset($response->errorCode) && $response->errorCode == '00000001') {
            return true;
        }
        
        return false;
    }

    public function changePassword(ChangePassword $changePassword)
    {
        $response = $this->sendPostRequest('changePasswordcodewise/', $changePassword->jsonSerialize());
        
        if (isset($response->errorCode) && $response->errorCode == '00000001') {
            return true;
        }
        
        return false;
    }

    public function apiPostRequest($path, $data)
    {
        $object = new \stdClass();

        $object->errorCode = '00000000';

        try {
            $request = $this->api->post($path, array(), $data);

            $response = $request->send();

            $json = $response->getBody(true);

            $object = $json;
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return $object;
    }

    public function addReward(AddReward $addReward)
    {
        $response = $this->sendPostRequest('marvel/addReward/', $addReward->jsonSerialize());

        return $response;
    }

    public function getRewardAdjustments($codewiseMemberId)
    {
        $data = array(
            'loyaltyID' => $codewiseMemberId,
        );

        $response = $this->sendPostRequest('marvel/getRewardAdjustments/', $data);

        if (isset($response->rewardAdjustments)) {
            return $response->rewardAdjustments;
        }

        return array();
    }

}
