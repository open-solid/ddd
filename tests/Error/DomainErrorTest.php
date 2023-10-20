<?php

namespace Ddd\Tests\Error;

use Ddd\Error\DomainError;
use Ddd\Error\EntityNotFoundError;
use Ddd\Error\InvalidArgumentError;
use PHPUnit\Framework\TestCase;

class DomainErrorTest extends TestCase
{
    public function testDefaultMessage(): void
    {
        $this->expectException(DomainError::class);
        $this->expectExceptionMessage('A domain error occurred.');

        throw DomainError::create();
    }

    public function testCreateMany(): void
    {
        $this->expectException(DomainError::class);
        $this->expectExceptionMessage("Domain error one.\nDomain error two.");

        $e = DomainError::createMany([
            DomainError::create('Domain error one.'),
            DomainError::create('Domain error two.'),
        ]);
        $this->assertCount(2, $e->getExceptions());

        throw $e;
    }

    public function testCustomError(): void
    {
        $this->expectException(DomainError::class);
        $this->expectExceptionMessage("A domain error occurred.\nInvalid argument value.\nEntity not found.");

        $e = DomainError::createMany([
            DomainError::create(),
            InvalidArgumentError::create(),
            EntityNotFoundError::create(),
        ]);
        $this->assertCount(3, $e->getExceptions());

        throw $e;
    }
}
