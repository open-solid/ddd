<?php

namespace OpenSolid\Ddd\Infrastructure\Event;

use OpenSolid\Ddd\Domain\Event\DomainEvent;
use OpenSolid\Ddd\Domain\Event\DomainEventBus;
use Symfony\Component\Messenger\MessageBusInterface;

readonly class SymfonyDomainEventBus implements DomainEventBus
{
    public function __construct(private MessageBusInterface $eventBus)
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->eventBus->dispatch($event);
        }
    }
}
