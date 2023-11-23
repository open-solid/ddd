<?php

namespace OpenSolid\Ddd\Infrastructure\Event;

use OpenSolid\Ddd\Domain\Event\DomainEvent;
use OpenSolid\Ddd\Domain\Event\DomainEventBus;
use OpenSolid\Messenger\Bus\FlushableMessageBus;
use OpenSolid\Messenger\Bus\LazyMessageBus;

readonly class NativeDomainEventBus implements DomainEventBus, FlushableMessageBus
{
    public function __construct(private LazyMessageBus $messageBus)
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->messageBus->dispatch($event);
        }
    }

    public function flush(): void
    {
        $this->messageBus->flush();
    }
}
