<?php

namespace Kumite\KumiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="kumite_event")
 * @ORM\Entity(repositoryClass="NinetyNine\KumiteBundle\Entity\EventRepository")
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="test_key", type="string", length=255)
     */
    private $testKey;

    /**
     * @var string
     *
     * @ORM\Column(name="variant_key", type="string", length=255)
     */
    private $variantKey;

    /**
     * @var string
     *
     * @ORM\Column(name="event_key", type="string", length=255)
     */
    private $eventKey;

    /**
     * @var integer
     *
     * @ORM\Column(name="value", type="integer", nullable=true)
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_created", type="datetime")
     */
    private $timeCreated;

    /**
     * @var integer
     *
     * @ORM\Column(name="participant_id", type="integer")
     */
    private $participantId;

    /**
     * @var array
     *
     * @ORM\Column(name="metadata", type="json_array", nullable=true)
     */
    private $metadata;


    public function getId()
    {
        return $this->id;
    }

    public function setTestKey($testKey)
    {
        $this->testKey = $testKey;
        return $this;
    }

    public function getTestKey()
    {
        return $this->testKey;
    }

    public function setVariantKey($variantKey)
    {
        $this->variantKey = $variantKey;
        return $this;
    }

    public function getVariantKey()
    {
        return $this->variantKey;
    }

    public function setEventKey($eventKey)
    {
        $this->eventKey = $eventKey;
        return $this;
    }

    public function getEventKey()
    {
        return $this->eventKey;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setTimeCreated($timeCreated)
    {
        $this->timeCreated = $timeCreated;
        return $this;
    }

    public function getTimeCreated()
    {
        return $this->timeCreated;
    }

    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
        return $this;
    }

    public function getMetadata()
    {
        return $this->metadata;
    }

    public function getParticipantId()
    {
        return $this->participantId;
    }

    public function setParticipantId($participantId)
    {
        $this->participantId = $participantId;
    }
}
