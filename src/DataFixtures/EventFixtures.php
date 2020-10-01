<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Event;
use App\Util\DateUtc;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EventFixtures extends Fixture
{
    public const EVENTS = [
        [
            'title' => null,
            'description' => null,
            'rsvp_url' => null,
            'meetup_id' => 226158970,
            'meetup_venue_id' => 24159763,
            'joindin_event_name' => 'PHPMiNDS %s %s', // PHPMiNDS December 2015
            'joindin_talk_id' => 16610,
            'joindin_url' => 'https://m.joind.in/talk/view/%s',
            'meetup_date' => '2015-12-17 19:00:00',
        ],
        [
            'title' => 'An Introduction to Kubernetes by Marcus Noble',
            'description' => "<p>A no-nonsense introduction to what Kubernetes is. We'll cover some of the core concepts you'll need to understand how Kubernetes operates and what they are used for. We'll finish off with looking at why we would choose to use Kubernetes by looking at its main strengths.</p> <p>Marcus is a Senior DevOps engineer at Elsevier, working for the past two years to build out their internal Kubernetes offerings. Follow him on twitter @Marcus_Noble_</p> <p>This is an online meetup - event access details will be posted here on the event night, please rsvp.</p>",
            'rsvp_url' => 'https://www.meetup.com/PHPMiNDS-in-Nottingham/events/271420212/',
            'meetup_id' => 42,
            'meetup_venue_id' => 314,
            'joindin_event_name' => 'PHPMiNDS %s %s',
            'joindin_talk_id' => 6128,
            'joindin_url' => 'https://m.joind.in/talk/view/%s',
            'meetup_date' => '2020-08-13 19:00:00',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EVENTS as $event) {
            $meetupDate = $this->getMeetupDate($event['meetup_date']);
            $manager->persist(
                Event::fromArray($event, $meetupDate)
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
