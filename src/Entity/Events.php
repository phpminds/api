<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Events.
 *
 * @ORM\Table(name="events", indexes={@ORM\Index(name="meetup_id", columns={"meetup_id", "speaker_id"})})
 * @ORM\Entity
 */
class Events
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="meetup_id", type="integer", nullable=false)
     */
    private $meetupId;

    /**
     * @var int
     *
     * @ORM\Column(name="meetup_venue_id", type="integer", nullable=false)
     */
    private $meetupVenueId;

    /**
     * @var string
     *
     * @ORM\Column(name="joindin_event_name", type="string", length=60, nullable=false)
     */
    private $joindinEventName;

    /**
     * @var int
     *
     * @ORM\Column(name="joindin_talk_id", type="integer", nullable=false)
     */
    private $joindinTalkId;

    /**
     * @var string
     *
     * @ORM\Column(name="joindin_url", type="string", length=253, nullable=false)
     */
    private $joindinUrl;

    /**
     * @var int
     *
     * @ORM\Column(name="speaker_id", type="integer", nullable=false)
     */
    private $speakerId;

    /**
     * @var int
     *
     * @ORM\Column(name="supporter_id", type="integer", nullable=false)
     */
    private $supporterId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="meetup_date", type="datetime", nullable=false)
     */
    private $meetupDate;
}
