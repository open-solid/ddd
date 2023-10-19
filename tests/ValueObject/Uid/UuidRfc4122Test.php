<?php

namespace Ddd\Tests\ValueObject\Uid;

use Ddd\Error\InvalidArgumentError;
use Ddd\ValueObject\Uid\UuidRfc4122;
use PHPUnit\Framework\TestCase;

class UuidRfc4122Test extends TestCase
{
    public function testCreate(): void
    {
        $id = UuidRfc4122::create();

        $this->assertSame(36, strlen($id->value()));
    }

    public function testCreateFromString(): void
    {
        $id = UuidRfc4122::fromString('f81d4fae-7dec-11d0-a765-00a0c91e6bf6');

        $this->assertSame(36, strlen($id->value()));
        $this->assertSame('f81d4fae-7dec-11d0-a765-00a0c91e6bf6', $id->value());
    }

    public function testCreateFromStringInvalid(): void
    {
        $this->expectException(InvalidArgumentError::class);
        $this->expectExceptionMessage('Invalid UUID: "f81d4fae".');

        UuidRfc4122::fromString('f81d4fae');
    }

    public function testEquals(): void
    {
        $id1 = UuidRfc4122::fromString('f81d4fae-7dec-11d0-a765-00a0c91e6bf6');
        $id2 = UuidRfc4122::fromString('f81d4fae-7dec-11d0-a765-00a0c91e6bf6');
        $id3 = UuidRfc4122::fromString('f81d4fae-7dec-11d0-a765-00a0c91e6bf7');

        $this->assertTrue($id1->equals($id2));
        $this->assertFalse($id1->equals($id3));
    }

    public function testToString(): void
    {
        $id = UuidRfc4122::fromString('f81d4fae-7dec-11d0-a765-00a0c91e6bf6');

        $this->assertSame('f81d4fae-7dec-11d0-a765-00a0c91e6bf6', (string) $id);
    }
}
