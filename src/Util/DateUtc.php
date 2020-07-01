<?php

declare(strict_types=1);

namespace App\Util;

final class DateUtc
{
    public static function now(): \DateTimeImmutable
    {
        return new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
    }
}
