<?php

declare(strict_types=1);

namespace Ddd\Tests\Domain\ValueObject\Integer;

use Ddd\Domain\Error\InvalidArgument;
use Ddd\Domain\ValueObject\Integer\PositiveInteger;
use PHPUnit\Framework\TestCase;

class PositiveIntegerTest extends TestCase
{
    public function testPositiveInteger(): void
    {
        $i = PositiveInteger::from(1);

        $this->assertSame(1, $i->value());
    }

    public function testNegativeInteger(): void
    {
        $this->expectException(InvalidArgument::class);
        $this->expectExceptionMessage('Value must be positive.');

        PositiveInteger::from(-1);
    }
}
