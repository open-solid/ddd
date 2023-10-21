<?php

namespace Ddd\Tests\Domain\Event;

use Ddd\Domain\Event\NativeDomainEventPublisher;
use Ddd\Tests\Domain\Entity\EntityUpdated;
use PHPUnit\Framework\TestCase;

class NativeDomainEventBusTest extends TestCase
{
    public function testPublishAndSubscriber(): void
    {
        $tester = $this;
        $subscribers = [
            EntityUpdated::class => new class($tester) {
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
        $publisher = new NativeDomainEventPublisher($subscribers);
        $publisher->publish(new EntityUpdated('uuid'));
    }
}
