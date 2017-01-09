<?php

namespace RAPP\Bundle\LoyaltyBundle\Service;

use Doctrine\ORM\EntityManager;
use RAPP\Bundle\DataBundle\Entity\IndividualEmailAddress;
use RAPP\MessageBundle\Message\ExactTarget\ExactTargetClient;
use RAPP\MessageBundle\Message\ExactTarget\ExactTargetRequest;
use RAPP\MessageBundle\Message\ExactTarget\ExactTargetSubscriber;
use RAPP\MessageBundle\Message\ExactTarget\TriggeredSendDefinition;
use RAPP\MessageBundle\Message\ExactTarget\TriggeredSendObject;
use RAPP\MessageBundle\Service\ExactTargetSoapClient;

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

    private function getIndividualEmailAddress($brinkerMemberId)
    {
        $repository = $this->em->getRepository('RAPPDataBundle:IndividualEmailAddress');

        $individualEmailAddress = $repository->getByBrinkerMemberIdAndDivision($brinkerMemberId, 1);

        if (!$individualEmailAddress instanceof IndividualEmailAddress) {
            throw new \Exception("Individual Email Address not found [BMID = $brinkerMemberId].");
        }

        return $individualEmailAddress;
    }

    public function sendBirthdayMessage($brinkerMemberId)
    {
        $individualEmailAddress = $this->getIndividualEmailAddress($brinkerMemberId);

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
