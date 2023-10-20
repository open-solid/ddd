<?php

declare(strict_types=1);

namespace Ddd\Tests\ValueObject\Integer;

use Ddd\ValueObject\Integer\Integer;
use PHPUnit\Framework\TestCase;

class IntegerTest extends TestCase
{
    public function testCreate(): void
    {
        $i = Integer::from(1);

        $this->assertSame(1, $i->value());
    }

    public function testEquals(): void
    {
        $i = Integer::from(1);
        $j = Integer::from(1);
        $k = Integer::from(2);

        $this->assertTrue($i->equals($j));
        $this->assertFalse($i->equals($k));
    }

    public function testGreaterThan(): void
    {
        $i = Integer::from(2);
        $j = Integer::from(1);
        $k = Integer::from(2);

        $this->assertTrue($i->greaterThan($j));
        $this->assertFalse($i->greaterThan($k));
    }

    public function testGreaterThanOrEqual(): void
    {
        $i = Integer::from(2);
        $j = Integer::from(1);
        $k = Integer::from(2);

        $this->assertTrue($i->greaterThanOrEqual($j));
        $this->assertTrue($i->greaterThanOrEqual($k));
    }

    public function testLessThan(): void
    {
        $i = Integer::from(2);
        $j = Integer::from(1);
        $k = Integer::from(2);

        $this->assertTrue($j->lessThan($i));
        $this->assertFalse($k->lessThan($i));
    }

    public function testLessThanOrEqual(): void
    {
        $i = Integer::from(2);
        $j = Integer::from(1);
        $k = Integer::from(2);

        $this->assertTrue($j->lessThanOrEqual($i));
        $this->assertTrue($k->lessThanOrEqual($i));
    }

    public function testMultiply(): void
    {
        $i = Integer::from(2);
        $j = Integer::from(3);
        $k = Integer::from(6);

        $this->assertTrue($k->equals($i->multiply($j)));
    }

    public function testDivide(): void
    {
        $i = Integer::from(6);
        $j = Integer::from(3);
        $k = Integer::from(2);

        $this->assertTrue($k->equals($i->divide($j)));
    }

    public function testModule(): void
    {
        $i = Integer::from(6);
        $j = Integer::from(3);
        $k = Integer::from(0);

        $this->assertTrue($k->equals($i->module($j)));
    }

    public function testToString(): void
    {
        $i = Integer::from(1);

        $this->assertSame('1', $i->toString());
        $this->assertSame('1', (string) $i);
    }
}
