<?php

declare(strict_types=1);

namespace PHPMinds\Unit\Event;

use App\Entity\Event;
use App\Event\Events;
use App\Event\Refresh;
use PHPUnit\Framework\TestCase;
use App\Event\Client\EventPayload;
use App\Repository\EventRepository;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use App\Event\Client\EventClientInterface;
use PHPUnit\Framework\MockObject\MockObject;

class EventsTest extends TestCase
{
    /**
     * @var EventClientInterface|MockObject
     */
    private $eventClient;

    /**
     * @var EventRepository<Event>|MockObject
     */
    private $eventRepository;

    private Refresh $refresh;

    protected function setUp(): void
    {
        $this->eventClient = $this->createMock(EventClientInterface::class);
        $this->eventRepository = $this->createMock(EventRepository::class);
        $this->refresh = new Refresh(0);
    }

    /**
     * @test
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function get_latest_event_returns_null(): void
    {
        $events = new Events($this->eventClient, $this->eventRepository, $this->refresh);

        $eventPayload = $this->createMock(EventPayload::class);
        $eventPayload->method('isEmpty')->willReturn(true);

        $this->eventRepository->method('fetchLatestEvent')->willReturn(null);
        $this->eventClient->method('fetchLatestEvent')->willReturn($eventPayload);

        $this->assertNull($events->getLatestEvent());
    }

    /**
     * @test
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \JsonException
     */
    public function can_fetch_latest_event_from_event_client(): void
    {
        $events = new Events($this->eventClient, $this->eventRepository, $this->refresh);

        $responseBody = $this->createMock(StreamInterface::class);
        $responseBody->method('getContents')->willReturn(\json_encode($this->getHttpResponseAsArray()));

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')->willReturn($responseBody);

        $eventPayload = EventPayload::createFromResponse($response);

        $this->eventRepository->method('fetchLatestEvent')->willReturn(null);
        $this->eventClient->method('fetchLatestEvent')->willReturn($eventPayload);

        $this->assertInstanceOf(Event::class, $events->getLatestEvent());
    }

    /**
     * @test
     */
    public function get_past_events_return_empty_array(): void
    {
        $this->eventRepository->method('fetchPastEvents')->willReturn([]);

        $events = new Events($this->eventClient, $this->eventRepository, $this->refresh);

        $this->assertEquals([], $events->getPastEvents());
    }

    /**
     * @return array<string, string|array>
     */
    private function getHttpResponseAsArray(): array
    {
        return [
            'group' => 'PHPMiNDS',
            'group_photo' => 'https://secure.meetupstatic.com/photos/event/9/7/e/f/highres_443318895.jpeg',
            'group_description' => '
            <p>We are a PHP User Group based in Nottingham.</p>
            <p>Meeting on the 1st Thursday of each month at 7pm at the JH Offices (34a Stoney St, Nottingham NG1 1NB) <br></p>
            <p>Our aim is to bring the PHP community together to collaborate, network and share knowledge in a friendly and professional environment.</p>
            <p>We welcome people at all levels and from all backgrounds. If you’re interested in PHP, working with Drupal or WordPress or any web technologies, you are most welcome to join us.</p>
            <p>You can find us on:&nbsp;</p>
            <p>Slack -&gt; <a href="http://slack.phpminds.org/" class="linkified">http://slack.phpminds.org/</a></p>
            <p>Twitter -&gt; @PHPMinds</p>
            <p> <br></p>
            <p> <br></p> ',
            'next_event' => [],
            'subject' => 'An Introduction to Kubernetes by Marcus Noble',
            'description' => "<p>A no-nonsense introduction to what Kubernetes is. We'll cover some of the core concepts you'll need to understand how Kubernetes operates and what they are used for. We'll finish off with looking at why we would choose to use Kubernetes by looking at its main strengths.</p> <p>Marcus is a Senior DevOps engineer at Elsevier, working for the past two years to build out their internal Kubernetes offerings. Follow him on twitter @Marcus_Noble_</p> <p>This is an online meetup - event access details will be posted here on the event night, please rsvp.</p>",
            'date_time' => 'Thursday 9th July 2020 at 6:30pm',
            'location' => 'Online event, , ',
            'event_url' => 'https://www.meetup.com/PHPMiNDS-in-Nottingham/events/271420212/',
            'iso_date' => '2020-07-09T18:30:00+01:00',
        ];
    }
}
