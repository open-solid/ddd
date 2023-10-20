<?php

namespace Ddd\Infrastructure\Event;

use Ddd\Domain\Event\DomainEvent;
use Ddd\Domain\Event\DomainEventBus;
use Ddd\Domain\Event\DomainEventSubscriber;

readonly class InMemoryDomainEventBus implements DomainEventBus
{
    /**
     * @param array<class-string, DomainEventSubscriber> $subscribers
     */
    public function __construct(private array $subscribers)
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            if (null === $subscriber = $this->subscribers[get_class($event)] ?? null) {
                continue;
            }

            if (method_exists($subscriber, '__invoke')) {
                $subscriber->__invoke($event);
            }
        }
    }
}
