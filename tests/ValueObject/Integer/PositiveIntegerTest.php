<?php

declare(strict_types=1);

namespace Ddd\Tests\ValueObject\Integer;

use Ddd\Error\InvalidArgumentError;
use Ddd\ValueObject\Integer\PositiveInteger;
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
        $this->expectException(InvalidArgumentError::class);
        $this->expectExceptionMessage('Value must be positive.');

        PositiveInteger::from(-1);
    }
}
