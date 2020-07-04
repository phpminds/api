<?php

declare(strict_types=1);

namespace PHPMinds\Unit\Event;

use App\Util\DateUtc;
use App\Event\Refresh;
use PHPUnit\Framework\TestCase;

final class RefreshTest extends TestCase
{
    /**
     * @test
     */
    public function cannot_create_with_negative_seconds(): void
    {
        $this->expectException(\RuntimeException::class);

        new Refresh(-10);
    }

    /**
     * @test
     */
    public function cannot_refresh_if_seconds_set_to_zero(): void
    {
        $now = DateUtc::now();

        $this->assertFalse((new Refresh(0))->canRefresh($now, $now));
    }

    /**
     * @test
     */
    public function can_refresh_when_reached_interval(): void
    {
        /** @var \DateTimeImmutable $updatedOn */
        $updatedOn = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2020-01-01 09:10:10');
        /** @var \DateTimeImmutable $now */
        $now = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2020-01-01 09:10:41');

        $this->assertTrue((new Refresh(30))->canRefresh($updatedOn, $now));
    }

    /**
     * @test
     */
    public function cannot_refresh_when_before_interval(): void
    {
        /** @var \DateTimeImmutable $updatedOn */
        $updatedOn = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2020-01-01 09:10:10');
        /** @var \DateTimeImmutable $now */
        $now = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2020-01-01 09:10:15');

        $this->assertFalse((new Refresh(30))->canRefresh($updatedOn, $now));
    }
}
