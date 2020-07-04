<?php

declare(strict_types=1);

namespace App\Entity;

use App\Util\DateUtc;
use Doctrine\ORM\Mapping as ORM;
use App\Event\Client\EventPayload;

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
     * @var int|null
     *
     * @ORM\Column(name="joindin_talk_id", type="integer", nullable=true)
     */
    private ?int $joindinTalkId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="joindin_url", type="string", length=253, nullable=true)
     */
    private ?string $joindinUrl;

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
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="updated", type="datetime_immutable", nullable=false)
     */
    private \DateTimeImmutable $updated;

    /**
     * @param string             $joindinEventName
     * @param \DateTimeImmutable $meetupDate
     * @param \DateTimeImmutable $updated
     * @param string|null        $title
     * @param string|null        $description
     * @param string|null        $rsvpUrl
     * @param int|null           $joindinTalkId
     * @param string|null        $joindinUrl
     * @param int|null           $meetupId
     * @param int|null           $meetupVenueId
     * @param int|null           $speakerId
     * @param int|null           $supporterId
     */
    public function __construct(
        string $joindinEventName,
        \DateTimeImmutable $meetupDate,
        \DateTimeImmutable $updated,
        ?string $title = null,
        ?string $description = null,
        ?string $rsvpUrl = null,
        ?int $joindinTalkId = null,
        ?string $joindinUrl = null,
        ?int $meetupId = null,
        ?int $meetupVenueId = null,
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
        $this->updated = $updated;
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
     * @return int|null
     */
    public function getJoindinTalkId(): ?int
    {
        return $this->joindinTalkId;
    }

    /**
     * @return string|null
     */
    public function getJoindinUrl(): ?string
    {
        return $this->joindinUrl;
    }

    /**
     * @return int|null
     */
    public function getSpeakerId(): ?int
    {
        return $this->speakerId;
    }

    /**
     * @return int|null
     */
    public function getSupporterId(): ?int
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

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdated(): \DateTimeImmutable
    {
        return $this->updated;
    }

    public function mutate(Event $updatedEvent): void
    {
        $this->title = $updatedEvent->getTitle();
        $this->description = $updatedEvent->getDescription();
        $this->meetupDate = $updatedEvent->getMeetupDate();
        $this->rsvpUrl = $updatedEvent->getRsvpUrl();
        $this->updated = DateUtc::now();
    }

    /**
     * @param array<string, string|int|null> $data
     * @param \DateTimeImmutable             $meetupDate
     *
     * @return Event
     */
    public static function fromArray(array $data, \DateTimeImmutable $meetupDate): Event
    {
        self::verify($data);

        return new self(
            \sprintf((string) $data['joindin_event_name'], $meetupDate->format('F'), $meetupDate->format('Y')),
            $meetupDate,
            DateUtc::now(),
            null === $data['title'] ? $data['title'] : (string) $data['title'],
            null === $data['description'] ? null : (string) $data['description'],
            null === $data['rsvp_url'] ? null : (string) $data['rsvp_url'],
            (int) $data['joindin_talk_id'],
            \sprintf((string) $data['joindin_url'], (int) $data['joindin_talk_id']),
            null === $data['meetup_id'] ? null : (int) $data['meetup_id'],
            null === $data['meetup_venue_id'] ? null : (int) $data['meetup_venue_id'],
        );
    }

    /**
     * @param array<string, string|int|null> $data
     *
     * @throws \InvalidArgumentException
     */
    private static function verify(array $data): void
    {
        $params = [
            'joindin_event_name',
            'joindin_talk_id',
            'joindin_url',
            'joindin_talk_id',
            'meetup_id',
            'meetup_venue_id',
            'title',
            'description',
            'rsvp_url',
        ];

        $matchedParams = array_diff_key($data, $params);

        if (count($matchedParams) !== count($params)) {
            foreach ($params as $param) {
                if (!in_array($param, $matchedParams, true)) {
                    throw new \InvalidArgumentException(
                        \sprintf(
                            'Missing required parameters %s',
                            \print_r($matchedParams, true)
                        )
                    );
                }
            }
        }
    }

    public static function fromPayload(EventPayload $eventPayload): Event
    {
        return new self(
            self::getEventName($eventPayload->getDate()),
            $eventPayload->getDate(),
            DateUtc::now(),
            $eventPayload->getTitle(),
            $eventPayload->getDescription(),
            $eventPayload->getRsvpUrl()
        );
    }

    private static function getEventName(\DateTimeImmutable $meetupDate): string
    {
        return \sprintf('PHPMiNDS %s %s', $meetupDate->format('F'), $meetupDate->format('Y'));
    }
}
