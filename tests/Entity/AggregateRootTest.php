<?php

namespace Ddd\Tests\Entity;

use DateTimeImmutable;
use Ddd\Entity\AggregateRoot;
use Ddd\Error\DomainError;
use Ddd\Error\InvalidArgumentError;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\UuidV7;

class AggregateRootTest extends TestCase
{
    public function testDomainError(): void
    {
        $this->expectException(DomainError::class);
        $this->expectExceptionMessage("Domain error one.\nDomain error two.");

        $entity = new class() {
            use AggregateRoot;

            public function accept(): void
            {
                $this->pushDomainError('Domain error one.');
                $this->pushDomainError('Domain error two.');
                $this->throwDomainErrors();
            }
        };

        $entity->accept();
    }

    public function testCustomDomainError(): void
    {
        $this->expectException(DomainError::class);
        $this->expectExceptionMessage("Domain error.\nInvalid argument.");

        $entity = new class() {
            use AggregateRoot;

            public function accept(): void
            {
                $this->pushDomainError('Domain error.');
                $this->pushDomainError(InvalidArgumentError::create('Invalid argument.'));
                $this->throwDomainErrors();
            }
        };

        $entity->accept();
    }

    public function testDomainEventRecording(): void
    {
        $entity = new class() {
            use AggregateRoot;

            public function update(): void
            {
                $this->pushDomainEvent(new EntityUpdatedEvent('uuid'));
            }
        };

        $entity->update();

        $this->assertCount(1, $events = $entity->pullDomainEvents());
        $this->assertInstanceOf(EntityUpdatedEvent::class, $events[0]);
        $this->assertSame('uuid', $events[0]->aggregateId);
        $this->assertTrue(UuidV7::isValid($events[0]->eventId));
        $this->assertInstanceOf(DateTimeImmutable::class, $events[0]->occurredOn);
    }
}
