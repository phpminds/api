<?php

declare(strict_types=1);

namespace App\Event\Client;

use Psr\Http\Message\ResponseInterface;

class EventPayload
{
    /**
     * @var string|null
     *
     * @readonly
     */
    private ?string $title;

    /**
     * @var string|null
     *
     * @readonly
     */
    private ?string $description;

    /**
     * @var \DateTimeImmutable|null
     *
     * @readonly
     */
    private ?\DateTimeImmutable $date;

    /**
     * @var string|null
     *
     * @readonly
     */
    private ?string $rsvpUrl;

    /**
     * @param array<string, string|null> $data
     */
    private function __construct(array $data)
    {
        $this->title = $this->getStringOrNull('subject', $data);
        $this->description = $this->getStringOrNull('description', $data);
        $this->rsvpUrl = $this->getStringOrNull('event_url', $data);
        $this->setDate($this->getStringOrNull('iso_date', $data));
    }

    public function isEmpty(): bool
    {
        return null === $this->title;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return string|null
     */
    public function getRsvpUrl(): ?string
    {
        return $this->rsvpUrl;
    }

    /**
     * @param string                     $param
     * @param array<string, string|null> $data
     *
     * @return string|null
     */
    private function getStringOrNull(string $param, array $data): ?string
    {
        if (!isset($data[$param]) || '' === \trim($data[$param])) {
            return null;
        }

        return $data[$param];
    }

    private function setDate(?string $date): void
    {
        if (null === $date) {
            $this->date = null;

            return;
        }

        $dateObject = \DateTimeImmutable::createFromFormat(\DateTimeInterface::ISO8601, $date);

        if (!$dateObject instanceof \DateTimeImmutable) {
            $this->date = null;

            return;
        }

        $this->date = $dateObject;
    }

    public static function createFromResponse(ResponseInterface $response): EventPayload
    {
        $eventData = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        return new self($eventData);
    }
}
