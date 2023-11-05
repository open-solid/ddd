<?php

namespace Ddd\Domain\Event;

use Yceruto\Messenger\Bus\MessageBus;

readonly class NativeDomainEventBus implements DomainEventBus
{
    public function __construct(private MessageBus $messageBus)
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->messageBus->dispatch($event);
        }
    }
}
