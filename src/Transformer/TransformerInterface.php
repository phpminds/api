<?php

namespace App\Transformer;

use App\Entity\Event;

interface TransformerInterface
{
    /**
     * @param Event[]|null $events
     *
     * @return array<array<string,string>>>
     */
    public function transform(?array $events): array;
}
