<?php

declare(strict_types=1);

namespace App\Event\Client;

interface EventClientInterface
{
    public function fetchLatestEvent(): EventPayload;
}
