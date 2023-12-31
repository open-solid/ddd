<?php

declare(strict_types=1);

namespace OpenSolid\Ddd\Domain\Event;

interface DomainEventBus
{
    public function publish(DomainEvent ...$events): void;
}
