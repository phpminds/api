<?php

declare(strict_types=1);

namespace PHPMinds\Unit\Transformer;

use App\Entity\Event;
use App\Util\DateUtc;
use PHPUnit\Framework\TestCase;
use App\DataFixtures\EventFixtures;
use App\Transformer\EventTransformer;

class EventTransformerTest extends TestCase
{
    /**
     * @test
     * @dataProvider emptySetDataProvider
     *
     * @param array<int, mixed>|null $data
     */
    public function null_or_empty_data_return_empty_array(?array $data): void
    {
        $transformer = new EventTransformer();

        $this->assertSame([], $transformer->transform($data));
    }

    /**
     * @return array<int, array<int, mixed>>
     */
    public function emptySetDataProvider(): array
    {
        return [
            [null],
            [[]],
        ];
    }

    /**
     * @test
     * @dataProvider rsvpUrlDataProvider
     *
     * @param mixed $rsvpUrl
     * @param int|null $meetupId
     * @param string|null $expected
     */
    public function get_rsvp_url_or_null($rsvpUrl, ?int $meetupId, ?string $expected): void
    {
        $data = EventFixtures::EVENTS[1];
        $data['meetup_id'] = $meetupId;
        $data['rsvp_url'] = $rsvpUrl;

        $transformer = new EventTransformer();

        $event = Event::fromArray($data, DateUtc::now());
        $this->assertSame($expected, $transformer->transform([$event])[0]['rsvp_url']);
    }

    /**
     * @return array<int, array>
     */
    public function rsvpUrlDataProvider(): array
    {
        return [
            [null, null, null],
        ];
    }
}
