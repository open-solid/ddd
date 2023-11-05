<?php

namespace Ddd\Tests\Domain\Event;

use Ddd\Domain\Event\NativeDomainEventBus;
use Ddd\Tests\Domain\Entity\EntityUpdated;
use PHPUnit\Framework\TestCase;
use Yceruto\Messenger\Bus\NativeMessageBus;
use Yceruto\Messenger\Handler\HandlersCountPolicy;
use Yceruto\Messenger\Handler\HandlersLocator;
use Yceruto\Messenger\Middleware\HandleMessageMiddleware;

class NativeDomainEventBusTest extends TestCase
{
    public function testPublishAndSubscribe(): void
    {
        /** @psalm-suppress UnusedClosureParam */
        $subscriber = function (EntityUpdated $event): void {
            /** @psalm-suppress InternalMethod */
            $this->addToAssertionCount(1);
        };

        $bus = new NativeDomainEventBus(new NativeMessageBus([
            new HandleMessageMiddleware(new HandlersLocator([
                EntityUpdated::class => [$subscriber],
            ]), HandlersCountPolicy::NO_HANDLER),
        ]));

        $bus->publish(new EntityUpdated('uuid'));
    }
}
