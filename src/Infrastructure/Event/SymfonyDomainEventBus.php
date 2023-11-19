<?php

namespace Ddd\Infrastructure\Event;

use Ddd\Domain\Event\DomainEvent;
use Ddd\Domain\Event\DomainEventBus;
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
