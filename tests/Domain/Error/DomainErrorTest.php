<?php

declare(strict_types=1);

namespace OpenSolid\Tests\Ddd\Domain\Error;

use OpenSolid\Ddd\Domain\Error\DomainError;
use OpenSolid\Ddd\Domain\Error\EntityNotFound;
use OpenSolid\Ddd\Domain\Error\InvalidArgument;
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
        $this->assertCount(2, $e->getErrors());

        throw $e;
    }

    public function testCustomError(): void
    {
        $this->expectException(DomainError::class);
        $this->expectExceptionMessage("A domain error occurred.\nInvalid argument value.\nEntity not found.");

        $e = DomainError::createMany([
            DomainError::create(),
            InvalidArgument::create(),
            EntityNotFound::create(),
        ]);
        $this->assertCount(3, $e->getErrors());

        throw $e;
    }
}
