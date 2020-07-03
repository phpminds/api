<?php

declare(strict_types=1);

namespace App\Event\Client;

use GuzzleHttp\Client;

final class HttpClientFactory
{
    public static function create(string $baseUrl): Client
    {
        return new Client(['base_uri' => $baseUrl]);
    }
}
