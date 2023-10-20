<?php

namespace Ddd\Tests\Infrastructure\Event;

use Ddd\Domain\Event\DomainEventSubscriber;
use Ddd\Infrastructure\Event\InMemoryDomainEventBus;
use Ddd\Tests\Domain\Entity\EntityUpdatedEvent;
use PHPUnit\Framework\TestCase;

class InMemoryDomainEventBusTest extends TestCase
{
    public function testPublishAndSubscriber(): void
    {
        $tester = $this;
        $subscribers = [
            EntityUpdatedEvent::class => new class($tester) implements DomainEventSubscriber {
                public function __construct(private readonly TestCase $tester)
                {
                }

                public function __invoke(EntityUpdatedEvent $event): void
                {
                    /** @psalm-suppress InternalMethod */
                    $this->tester->addToAssertionCount(1);
                }
            },
        ];
        $bus = new InMemoryDomainEventBus($subscribers);
        $bus->publish(new EntityUpdatedEvent('uuid'));
    }
}
