<?php

namespace Ddd\Tests\Infrastructure\Event;

use Ddd\Domain\Event\DomainEventSubscriber;
use Ddd\Infrastructure\Event\InMemoryDomainEventPublisher;
use Ddd\Tests\Domain\Entity\EntityUpdated;
use PHPUnit\Framework\TestCase;

class InMemoryDomainEventBusTest extends TestCase
{
    public function testPublishAndSubscriber(): void
    {
        $tester = $this;
        $subscribers = [
            EntityUpdated::class => new class($tester) implements DomainEventSubscriber {
                public function __construct(private readonly TestCase $tester)
                {
                }

                public function __invoke(EntityUpdated $event): void
                {
                    /** @psalm-suppress InternalMethod */
                    $this->tester->addToAssertionCount(1);
                }
            },
        ];
        $publisher = new InMemoryDomainEventPublisher($subscribers);
        $publisher->publish(new EntityUpdated('uuid'));
    }
}
