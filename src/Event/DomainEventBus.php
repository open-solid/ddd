<?php

declare(strict_types=1);

namespace Ddd\Event;

interface DomainEventBus
{
    public function publish(DomainEvent ...$events): void;
}
