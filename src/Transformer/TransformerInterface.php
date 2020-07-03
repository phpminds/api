<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Entity\Event;

interface TransformerInterface
{
    /**
     * @param array<int, Event>|null $events
     *
     * @return array<int, array<string, string|null>>
     */
    public function transform(?array $events): array;
}
