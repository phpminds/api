<?php

declare(strict_types=1);

namespace PHPMinds\Unit\Entity;

use App\Entity\Event;
use App\Util\DateUtc;
use PHPUnit\Framework\TestCase;

final class EventTest extends TestCase
{
    /**
     * @test
     */
    public function create_from_array_throws_exception_on_missing_required_params(): void
    {
        $meetupDate = DateUtc::now();
        $this->expectException(\InvalidArgumentException::class);

        Event::fromArray([], $meetupDate);
    }
}
