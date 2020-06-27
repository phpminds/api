<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Events.
 *
 * @ORM\Table(name="events", indexes={@ORM\Index(name="meetup_id", columns={"meetup_id", "speaker_id"})})
 * @ORM\Entity
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private ?int $id = null;

    /**
     * @var int
     *
     * @ORM\Column(name="meetup_id", type="integer", nullable=false)
     */
    private int $meetupId;

    /**
     * @var int
     *
     * @ORM\Column(name="meetup_venue_id", type="integer", nullable=false)
     */
    private int $meetupVenueId;

    /**
     * @var string
     *
     * @ORM\Column(name="joindin_event_name", type="string", length=60, nullable=false)
     */
    private string $joindinEventName;

    /**
     * @var int
     *
     * @ORM\Column(name="joindin_talk_id", type="integer", nullable=false)
     */
    private int $joindinTalkId;

    /**
     * @var string
     *
     * @ORM\Column(name="joindin_url", type="string", length=253, nullable=false)
     */
    private string $joindinUrl;

    /**
     * @var int|null
     *
     * @ORM\Column(name="speaker_id", type="integer", nullable=true)
     */
    private ?int $speakerId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="supporter_id", type="integer", nullable=true)
     */
    private ?int $supporterId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="meetup_date", type="datetime", nullable=false)
     */
    private \DateTime $meetupDate;

    /**
     * @param int       $meetupId
     * @param int       $meetupVenueId
     * @param string    $joindinEventName
     * @param int       $joindinTalkId
     * @param string    $joindinUrl
     * @param \DateTime $meetupDate
     * @param int|null  $speakerId
     * @param int|null  $supporterId
     */
    public function __construct(
        int $meetupId,
        int $meetupVenueId,
        string $joindinEventName,
        int $joindinTalkId,
        string $joindinUrl,
        \DateTime $meetupDate,
        ?int $speakerId = null,
        ?int $supporterId = null
    ) {
        $this->meetupId = $meetupId;
        $this->meetupVenueId = $meetupVenueId;
        $this->joindinEventName = $joindinEventName;
        $this->joindinTalkId = $joindinTalkId;
        $this->joindinUrl = $joindinUrl;
        $this->speakerId = $speakerId;
        $this->supporterId = $supporterId;
        $this->meetupDate = $meetupDate;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getMeetupId(): int
    {
        return $this->meetupId;
    }

    /**
     * @return int
     */
    public function getMeetupVenueId(): int
    {
        return $this->meetupVenueId;
    }

    /**
     * @return string
     */
    public function getJoindinEventName(): string
    {
        return $this->joindinEventName;
    }

    /**
     * @return int
     */
    public function getJoindinTalkId(): int
    {
        return $this->joindinTalkId;
    }

    /**
     * @return string
     */
    public function getJoindinUrl(): string
    {
        return $this->joindinUrl;
    }

    /**
     * @return int
     */
    public function getSpeakerId(): int
    {
        return $this->speakerId;
    }

    /**
     * @return int
     */
    public function getSupporterId(): int
    {
        return $this->supporterId;
    }

    /**
     * @return \DateTime
     */
    public function getMeetupDate(): \DateTime
    {
        return $this->meetupDate;
    }
}
