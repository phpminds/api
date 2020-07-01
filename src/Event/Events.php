<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Event;
use App\Repository\EventRepository;

final class Events implements EventsInterface
{
    /**
     * @var EventRepository<Event>
     */
    private EventRepository $eventRepository;

    /**
     * @param EventRepository<Event> $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getLatestEvent(): ?Event
    {
        return null;
    }

    public function getPastEvents(): array
    {
        return $this->eventRepository->fetchPastEvents();
    }
}
