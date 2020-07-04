<?php

declare(strict_types=1);

namespace App\Event;

final class Refresh
{
    private int $refreshSeconds;

    public function __construct(int $refreshSeconds)
    {
        if ($refreshSeconds < 0) {
            throw new \RuntimeException('Refresh time cannot be below 0');
        }

        $this->refreshSeconds = $refreshSeconds;
    }

    public function canRefresh(\DateTimeImmutable $updatedOn, \DateTimeImmutable $now): bool
    {
        if (0 === $this->refreshSeconds) {
            return false;
        }

        return $updatedOn->add(new \DateInterval('PT'.$this->refreshSeconds.'S')) < $now;
    }
}
