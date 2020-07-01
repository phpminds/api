<?php

namespace App\Transformer;

use App\Entity\Event;

final class EventTransformer implements TransformerInterface
{
    /**
     * @param Event[]|null $events
     *
     * @return array<int, array<string, string|null>>
     */
    public function transform(?array $events): array
    {
        if (null === $events || 0 === count($events)) {
            return [];
        }

        $data = [];
        foreach ($events as $event) {
            $data[] = [
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'rsvp_url' => $this->getRsvpUrl($event),
                'joindin_url' => $event->getJoindinUrl(),
                'date' => $event->getMeetupDate()->format('c'),
            ];
        }

        return $data;
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
