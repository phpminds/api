<?php

namespace PHPMinds\Unit\Event;

use App\Entity\Event;
use App\Event\Events;
use PHPUnit\Framework\TestCase;
use App\Repository\EventRepository;
use PHPUnit\Framework\MockObject\MockObject;

class EventsTest extends TestCase
{
    /**
     * @var EventRepository<Event>|MockObject
     */
    private $eventRepository;

    protected function setUp(): void
    {
        $this->eventRepository = $this->createMock(EventRepository::class);
    }

    /**
     * @test
     */
    public function get_latest_event_returns_null(): void
    {
        $events = new Events($this->eventRepository);

        $this->assertNull($events->getLatestEvent());
    }

    /**
     * @test
     */
    public function get_past_events_return_empty_array(): void
    {
        $this->eventRepository->method('fetchPastEvents')->willReturn([]);

        $events = new Events($this->eventRepository);

        $this->assertEquals([], $events->getPastEvents());
    }
}
