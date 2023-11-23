<?php

namespace OpenSolid\Tests\Ddd\Infrastructure\Event;

use OpenSolid\Ddd\Infrastructure\Event\NativeDomainEventBus;
use PHPUnit\Framework\TestCase;
use OpenSolid\Tests\Ddd\Domain\Entity\EntityUpdated;
use OpenSolid\Messenger\Bus\NativeLazyMessageBus;
use OpenSolid\Messenger\Bus\NativeMessageBus;
use OpenSolid\Messenger\Handler\HandlersCountPolicy;
use OpenSolid\Messenger\Handler\HandlersLocator;
use OpenSolid\Messenger\Middleware\HandleMessageMiddleware;

class NativeDomainEventBusTest extends TestCase
{
    public function testPublishAndSubscribe(): void
    {
        /** @psalm-suppress UnusedClosureParam */
        $subscriber1 = function (EntityUpdated $event): void {
            /** @psalm-suppress InternalMethod */
            $this->addToAssertionCount(1);
        };

        /** @psalm-suppress UnusedClosureParam */
        $subscriber2 = function (EntityUpdated $event): void {
            /** @psalm-suppress InternalMethod */
            $this->addToAssertionCount(1);
        };

        $nativeMessageBus = new NativeMessageBus([
            new HandleMessageMiddleware(
                new HandlersLocator([
                    EntityUpdated::class => [$subscriber1, $subscriber2],
                ]), HandlersCountPolicy::NO_HANDLER
            ),
        ]);
        $bus = new NativeDomainEventBus(new NativeLazyMessageBus($nativeMessageBus));

        $bus->publish(new EntityUpdated('uuid'));
        $bus->flush();

        /** @psalm-suppress InternalMethod */
        $this->assertSame(2, $this->numberOfAssertionsPerformed());
    }

    public function testNoSubscriberForEvent(): void
    {
        $this->expectNotToPerformAssertions();

        $nativeMessageBus = new NativeMessageBus([
            new HandleMessageMiddleware(
                new HandlersLocator([]),
                HandlersCountPolicy::NO_HANDLER,
            ),
        ]);
        $bus = new NativeDomainEventBus(new NativeLazyMessageBus($nativeMessageBus));

        $bus->publish(new EntityUpdated('uuid'));
        $bus->flush();
    }
}
