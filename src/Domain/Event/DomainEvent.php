<?php

declare(strict_types=1);

namespace OpenSolid\Ddd\Domain\Event;

use DateTimeImmutable;
use OpenSolid\Ddd\Domain\ValueObject\Uid\UuidV7Rfc4122;
use OpenSolid\Messenger\Model\Message;

/**
 * @psalm-immutable
 */
readonly abstract class DomainEvent implements Message
{
    public string $eventId;
    public DateTimeImmutable $occurredOn;

    public function __construct(public string $aggregateId)
    {
        $this->eventId = UuidV7Rfc4122::generate();
        $this->occurredOn = new DateTimeImmutable();
    }
}
