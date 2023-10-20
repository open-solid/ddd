<?php

namespace Ddd\Event;

use DateTimeImmutable;
use Ddd\ValueObject\Uid\UuidV7Rfc4122;

readonly abstract class DomainEvent
{
    public string $eventId;
    public DateTimeImmutable $occurredOn;

    public function __construct(public string $aggregateId)
    {
        $this->eventId = UuidV7Rfc4122::generate();
        $this->occurredOn = new DateTimeImmutable();
    }
}
