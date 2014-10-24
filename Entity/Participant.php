<?php

namespace NinetyNine\KumiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="kumite_participant")
 * @ORM\Entity(repositoryClass="NinetyNine\KumiteBundle\Entity\ParticipantRepository")
 */
class Participant
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
     * @var \DateTime
     *
     * @ORM\Column(name="time_created", type="datetime")
     */
    private $timeCreated;

    /**
     * @var string
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
}
