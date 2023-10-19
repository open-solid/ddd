<?php

namespace Ddd\Tests\ValueObject\Uid;

use Ddd\Error\InvalidArgumentError;
use Ddd\ValueObject\Uid\UuidBase58;
use PHPUnit\Framework\TestCase;

class UuidBase58Test extends TestCase
{
    public function testCreate(): void
    {
        $id = UuidBase58::create();

        $this->assertSame(22, strlen($id->value()));
    }

    public function testCreateFromString(): void
    {
        $id = UuidBase58::fromString('1C4Gx3HwRKMqqm8pYTjiXg');

        $this->assertSame(22, strlen($id->value()));
        $this->assertSame('1C4Gx3HwRKMqqm8pYTjiXg', $id->value());
    }

    public function testCreateFromStringInvalid(): void
    {
        $this->expectException(InvalidArgumentError::class);
        $this->expectExceptionMessage('Invalid UUID: "1C4Gx"');

        UuidBase58::fromString('1C4Gx');
    }

    public function testEquals(): void
    {
        $id1 = UuidBase58::fromString('1C4Gx3HwRKMqqm8pYTjiXg');
        $id2 = UuidBase58::fromString('1C4Gx3HwRKMqqm8pYTjiXg');
        $id3 = UuidBase58::fromString('1C4Gx3HwRKMqqm8pYTjiXh');

        $this->assertTrue($id1->equals($id2));
        $this->assertFalse($id1->equals($id3));
    }

    public function testToString(): void
    {
        $id = UuidBase58::fromString('1C4Gx3HwRKMqqm8pYTjiXg');

        $this->assertSame('1C4Gx3HwRKMqqm8pYTjiXg', (string) $id);
    }
}
