<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Event;
use App\Util\DateUtc;
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
     * @var Refresh
     */
    private Refresh $refresh;

    /**
     * @param EventClientInterface   $eventClient
     * @param EventRepository<Event> $eventRepository
     * @param Refresh                $refresh
     */
    public function __construct(EventClientInterface $eventClient, EventRepository $eventRepository, Refresh $refresh)
    {
        $this->eventClient = $eventClient;
        $this->eventRepository = $eventRepository;
        $this->refresh = $refresh;
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

        if ($latestEvent instanceof Event) {
            if ($this->refresh->canRefresh($latestEvent->getUpdated(), DateUtc::now())) {
                $latestEventPayload = $this->eventClient->fetchLatestEvent();
                if (!$latestEventPayload->isEmpty()) {
                    $updatedEvent = Event::fromPayload($latestEventPayload);
                    $latestEvent->mutate($updatedEvent);
                    $this->eventRepository->save($latestEvent);
                }
            }

            return $latestEvent;
        }

        $latestEventPayload = $this->eventClient->fetchLatestEvent();
        if ($latestEventPayload->isEmpty()) {
            return null;
        }

        $latestEvent = Event::fromPayload($latestEventPayload);
        $this->eventRepository->save($latestEvent);

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
