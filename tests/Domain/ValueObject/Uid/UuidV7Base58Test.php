<?php

declare(strict_types=1);

namespace OpenSolid\Tests\Ddd\Domain\ValueObject\Uid;

use OpenSolid\Ddd\Domain\Error\InvalidArgument;
use OpenSolid\Ddd\Domain\ValueObject\Uid\UuidV7Base58;
use PHPUnit\Framework\TestCase;

class UuidV7Base58Test extends TestCase
{
    public function testCreate(): void
    {
        $id = UuidV7Base58::create();

        $this->assertSame(22, strlen($id->value()));
    }

    public function testCreateFromString(): void
    {
        $id = UuidV7Base58::from('1C4Gx3HwRKMqqm8pYTjiXg');

        $this->assertSame(22, strlen($id->value()));
        $this->assertSame('1C4Gx3HwRKMqqm8pYTjiXg', $id->value());
    }

    public function testCreateFromStringInvalid(): void
    {
        $this->expectException(InvalidArgument::class);
        $this->expectExceptionMessage('Invalid UUID: "1C4Gx"');

        UuidV7Base58::from('1C4Gx');
    }

    public function testEquals(): void
    {
        $id1 = UuidV7Base58::from('1C4Gx3HwRKMqqm8pYTjiXg');
        $id2 = UuidV7Base58::from('1C4Gx3HwRKMqqm8pYTjiXg');
        $id3 = UuidV7Base58::from('1C4Gx3HwRKMqqm8pYTjiXh');

        $this->assertTrue($id1->equals($id2));
        $this->assertFalse($id1->equals($id3));
    }

    public function testToString(): void
    {
        $id = UuidV7Base58::from('1C4Gx3HwRKMqqm8pYTjiXg');

        $this->assertSame('1C4Gx3HwRKMqqm8pYTjiXg', (string) $id);
    }
}
