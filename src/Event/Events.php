<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Event;
use App\Repository\EventRepository;
use App\Event\Client\EventClientInterface;

final class Events implements EventsInterface
{
    private EventClientInterface $eventClient;

    /**
     * @var EventRepository<Event>
     */
    private EventRepository $eventRepository;

    /**
     * @param EventClientInterface   $eventClient
     * @param EventRepository<Event> $eventRepository
     */
    public function __construct(EventClientInterface $eventClient, EventRepository $eventRepository)
    {
        $this->eventClient = $eventClient;
        $this->eventRepository = $eventRepository;
    }

    /**
     * @return Event|null
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function getLatestEvent(): ?Event
    {
        $latestEvent = $this->eventRepository->fetchLatestEvent();

        if (!$latestEvent instanceof Event) {
            $latestEventPayload = $this->eventClient->fetchLatestEvent();
            if ($latestEventPayload->isEmpty()) {
                return null;
            }

            $latestEvent = Event::fromPayload($latestEventPayload);
            $this->eventRepository->save($latestEvent);
        }

        return $latestEvent;
    }

    /**
     * @return array<int, Event>
     */
    public function getPastEvents(): array
    {
        return $this->eventRepository->fetchPastEvents();
    }
}
