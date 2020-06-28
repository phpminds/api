<?php

namespace App\Transformer;

use App\Entity\Event;

interface TransformerInterface
{
    /**
     * @param Event[]|null $events
     *
     * @return array<int, array<string, string|null>>
     */
    public function transform(?array $events): array;
}
