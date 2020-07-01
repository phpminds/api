<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Entity\Event;

final class EventTransformer implements TransformerInterface
{
    /**
     * @param array<int, Event>|null $events
     *
     * @return array<int, array<string, string|null>>
     */
    public function transform(?array $events): array
    {
        if (null === $events || 0 === count($events)) {
            return [];
        }

        return \array_map(function ($event) {
            return [
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'rsvp_url' => $this->getRsvpUrl($event),
                'joindin_url' => $event->getJoindinUrl(),
                'date' => (string) $event->getMeetupDate()->format('c'),
            ];
        }, $events);
    }

    /**
     * Added for backwards-compatibility.
     *
     * @param Event $event
     *
     * @return string|null
     */
    private function getRsvpUrl(Event $event): ?string
    {
        if (null !== $event->getMeetupId() && null === $event->getRsvpUrl()) {
            return \sprintf('https://www.meetup.com/PHPMiNDS-in-Nottingham/events/%s/', $event->getMeetupId());
        }

        return $event->getRsvpUrl();
    }
}
