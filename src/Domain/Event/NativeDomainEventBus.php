<?php

namespace Ddd\Domain\Event;

use Yceruto\Messenger\Bus\FlushableMessageBus;
use Yceruto\Messenger\Bus\LazyMessageBus;

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
