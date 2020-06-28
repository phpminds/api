<?php

namespace App\Transformer;

use App\Entity\Event;

final class EventTransformer implements TransformerInterface
{
    /**
     * @param Event[]|null $events
     *
     * @return array<array<string,string>>>
     */
    public function transform(?array $events): array
    {
        if (null === $events || 0 === count($events)) {
            return [];
        }

        $data = [];
        foreach ($events as $event) {
            $data[] = [
                'title' => '',
                'description' => '',
                'rsvp_url' => '',
                'joindin_url' => $event->getJoindinUrl(),
                'date' => $event->getMeetupDate()->format('c'),
            ];
        }

        return $data;
    }
}
