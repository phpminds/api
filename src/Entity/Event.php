<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="events", indexes={@ORM\Index(name="meetup_id", columns={"meetup_id", "speaker_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
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
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     */
    private ?string $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rsvp_url", type="text", nullable=true)
     */
    private ?string $rsvpUrl;

    /**
     * @var int|null
     *
     * @ORM\Column(name="meetup_id", type="integer", nullable=true)
     */
    private ?int $meetupId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="meetup_venue_id", type="integer", nullable=true)
     */
    private ?int $meetupVenueId;

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
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="meetup_date", type="datetime_immutable", nullable=false)
     */
    private \DateTimeImmutable $meetupDate;

    /**
     * @param string             $joindinEventName
     * @param int                $joindinTalkId
     * @param string             $joindinUrl
     * @param \DateTimeImmutable $meetupDate
     * @param int|null           $meetupId
     * @param int|null           $meetupVenueId
     * @param string|null        $title
     * @param string|null        $description
     * @param string|null        $rsvpUrl
     * @param int|null           $speakerId
     * @param int|null           $supporterId
     */
    public function __construct(
        string $joindinEventName,
        int $joindinTalkId,
        string $joindinUrl,
        \DateTimeImmutable $meetupDate,
        ?int $meetupId = null,
        ?int $meetupVenueId = null,
        ?string $title = null,
        ?string $description = null,
        ?string $rsvpUrl = null,
        ?int $speakerId = null,
        ?int $supporterId = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->rsvpUrl = $rsvpUrl;
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
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getRsvpUrl(): ?string
    {
        return $this->rsvpUrl;
    }

    /**
     * @return int|null
     */
    public function getMeetupId(): ?int
    {
        return $this->meetupId;
    }

    /**
     * @return int|null
     */
    public function getMeetupVenueId(): ?int
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
     * @return \DateTimeImmutable
     */
    public function getMeetupDate(): \DateTimeImmutable
    {
        return $this->meetupDate;
    }
}
