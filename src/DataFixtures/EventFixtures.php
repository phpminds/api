<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Util\DateUtc;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EventFixtures extends Fixture
{
    private const EVENTS = [
        [
            'meetup_id' => 226158970,
            'meetup_venue_id' => 24159763,
            'joindin_event_name' => 'PHPMiNDS %s %s', // PHPMiNDS December 2015
            'joindin_talk_id' => 16610,
            'joindin_url' => 'https://m.joind.in/talk/view/%s',
            'meetup_date' => '2015-12-17 19:00:00',
        ],
        [
            'meetup_id' => 42,
            'meetup_venue_id' => 314,
            'joindin_event_name' => 'PHPMiNDS %s %s',
            'joindin_talk_id' => 6128,
            'joindin_url' => 'https://m.joind.in/talk/view/%s',
            'meetup_date' => null,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EVENTS as $event) {
            $meetupDate = $this->getMeetupDate($event['meetup_date']);
            $manager->persist(
                new Event(
                    $event['meetup_id'],
                    $event['meetup_venue_id'],
                    \sprintf($event['joindin_event_name'], $meetupDate->format('F'), $meetupDate->format('Y')),
                    $event['joindin_talk_id'],
                    \sprintf($event['joindin_url'], $event['joindin_talk_id']),
                    $meetupDate
                )
            );
        }
        $manager->flush();
    }

    private function getMeetupDate(?string $meetupDate): \DateTimeImmutable
    {
        if (null === $meetupDate) {
            // generate date for next month
            return DateUtc::now()->add(new \DateInterval('P1M'));
        }

        $date = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $meetupDate);
        if (!$date instanceof \DateTimeImmutable) {
            throw new \RuntimeException('Could not create date');
        }

        return $date;
    }
}
