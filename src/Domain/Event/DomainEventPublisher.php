<?php

declare(strict_types=1);

namespace Ddd\Domain\Event;

interface DomainEventPublisher
{
    public function publish(DomainEvent ...$events): void;
}
