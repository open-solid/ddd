<?php

namespace Ddd\Domain\Event;

readonly class NativeDomainEventPublisher implements DomainEventPublisher
{
    /**
     * @param array<class-string, callable> $subscribers
     */
    public function __construct(private array $subscribers = [])
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            if (null === $subscriber = $this->subscribers[get_class($event)] ?? null) {
                continue;
            }

            $subscriber($event);
        }
    }
}
