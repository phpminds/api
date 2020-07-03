<?php

declare(strict_types=1);

namespace App\Event\Client;

use GuzzleHttp\Client;

final class EventClient implements EventClientInterface
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return EventPayload
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function fetchLatestEvent(): EventPayload
    {
        return EventPayload::createFromResponse(
            $this->client->get('/index.php?group=PHPMinds')
        );
    }
}
