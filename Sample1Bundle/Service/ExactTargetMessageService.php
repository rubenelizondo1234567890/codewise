<?php

namespace codewise\Bundle\LoyaltyBundle\Service;

use Doctrine\ORM\EntityManager;
use codewise\Bundle\DataBundle\Entity\IndividualEmailAddress;
use codewise\MessageBundle\Message\ExactTarget\ExactTargetClient;
use codewise\MessageBundle\Message\ExactTarget\ExactTargetRequest;
use codewise\MessageBundle\Message\ExactTarget\ExactTargetSubscriber;
use codewise\MessageBundle\Message\ExactTarget\TriggeredSendDefinition;
use codewise\MessageBundle\Message\ExactTarget\TriggeredSendObject;
use codewise\MessageBundle\Service\ExactTargetSoapClient;

class ExactTargetMessageService
{

    /** @var EntityManager */
    private $em;

    /** @var ExactTargetSoapClient */
    private $exactTargetSoapClient;

    public function __construct(EntityManager $em, ExactTargetSoapClient $exactTargetSoapClient)
    {
        $this->em = $em;
        $this->exactTargetSoapClient = $exactTargetSoapClient;
    }

    private function getIndividualEmailAddress($codewiseMemberId)
    {
        $repository = $this->em->getRepository('codewiseDataBundle:IndividualEmailAddress');

        $individualEmailAddress = $repository->getBycodewiseMemberIdAndDivision($codewiseMemberId, 1);

        if (!$individualEmailAddress instanceof IndividualEmailAddress) {
            throw new \Exception("Individual Email Address not found [BMID = $codewiseMemberId].");
        }

        return $individualEmailAddress;
    }

    public function sendBirthdayMessage($codewiseMemberId)
    {
        $individualEmailAddress = $this->getIndividualEmailAddress($codewiseMemberId);

        $object = new TriggeredSendObject();

        $object->setClient(new ExactTargetClient(6226539));

        $tsd = new TriggeredSendDefinition();

        $tsd->setCustomerKey('R8_Birthday');

        $subscriber = new ExactTargetSubscriber();

        $subscriber->setSubscriberKey($individualEmailAddress->getSubscriberKey());
        $subscriber->setEmailAddress($individualEmailAddress->getEmailAddress());

        $object->setTriggeredSendDefinition($tsd);
        $object->addSubscriber($subscriber);

        $request = new ExactTargetRequest();

        $request->addObject($object);

        $response = $this->exactTargetSoapClient->Create($request);

        return $response;
    }

}
