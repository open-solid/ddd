<?php

namespace Tests\Ddd\Domain\Event;

use Ddd\Domain\Event\NativeDomainEventBus;
use Tests\Ddd\Domain\Entity\EntityUpdated;
use PHPUnit\Framework\TestCase;
use Yceruto\Messenger\Bus\NativeLazyMessageBus;
use Yceruto\Messenger\Bus\NativeMessageBus;
use Yceruto\Messenger\Handler\HandlersCountPolicy;
use Yceruto\Messenger\Handler\HandlersLocator;
use Yceruto\Messenger\Middleware\HandleMessageMiddleware;

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
