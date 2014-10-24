<?php

namespace NinetyNine\KumiteBundle\Kumite;

use Doctrine\ORM\EntityManager;
use NinetyNine\KumiteBundle\Entity\Event;
use NinetyNine\KumiteBundle\Entity\Participant;

class StorageAdapter implements \Kumite\Adapters\StorageAdapter
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createParticipant($testKey, $variantKey, $metadata = null)
    {
        $participant = new Participant();
        $participant->setTestKey($testKey);
        $participant->setVariantKey($variantKey);
        $participant->setMetadata($metadata);
        $participant->setTimeCreated(new \DateTime());
        $this->entityManager->persist($participant);
        $this->entityManager->flush();
        return $participant->getId();
    }

    public function createEvent($testKey, $variantKey, $eventKey, $participantId, $metadata = null)
    {
        $value = isset($metadata['value']) ? $metadata['value'] : null;

        $event = new Event();
        $event->setTestKey($testKey);
        $event->setVariantKey($variantKey);
        $event->setEventKey($eventKey);
        $event->setParticipantId($participantId);
        $event->setMetadata($metadata);
        $event->setValue($value);
        $event->setTimeCreated(new \DateTime());
        $this->entityManager->persist($event);
        $this->entityManager->flush();
    }

    public function countParticipants($testKey, $variantKey)
    {
        $dql = 'SELECT COUNT(p.id) FROM KumiteBundle:Participant p WHERE p.testKey = :t AND p.variantKey = :v';
        return $this->entityManager->createQuery($dql)
            ->setParameter('t', $testKey)
            ->setParameter('v', $variantKey)
            ->getSingleScalarResult();
    }

    public function countEvents($testKey, $variantKey, $eventKey)
    {
        $dql = 'SELECT COUNT(e.id) FROM KumiteBundle:Event e WHERE e.testKey = :t AND e.variantKey = :v AND e.eventKey = :e';
        return $this->entityManager->createQuery($dql)
            ->setParameter('t', $testKey)
            ->setParameter('v', $variantKey)
            ->setParameter('e', $eventKey)
            ->getSingleScalarResult();
    }
}
