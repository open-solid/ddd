<?php

declare(strict_types=1);

namespace Ddd\Tests\Domain\ValueObject\String;

use Ddd\Domain\ValueObject\String\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function testCreate(): void
    {
        $s = Str::from('foo');

        $this->assertSame('foo', $s->value());
    }

    public function testEquals(): void
    {
        $s1 = Str::from('foo');
        $s2 = Str::from('foo');
        $s3 = Str::from('bar');

        $this->assertTrue($s1->equalsTo($s2));
        $this->assertFalse($s1->equalsTo($s3));
    }

    public function testToString(): void
    {
        $s = Str::from('foo');

        $this->assertSame('foo', (string) $s);
        $this->assertSame('foo', $s->toString());
    }

    public function testLength(): void
    {
        $s = Str::from('foo');

        $this->assertSame(3, $s->length());
    }

    public function testIsEmpty(): void
    {
        $s1 = Str::from('foo');
        $s2 = Str::from('');

        $this->assertFalse($s1->isEmpty());
        $this->assertTrue($s2->isEmpty());
    }

    public function testTrim(): void
    {
        $s = Str::from(' foo ');

        $this->assertSame('foo', $s->trim()->value());
    }

    public function testToLower(): void
    {
        $s = Str::from('FOO');

        $this->assertSame('foo', $s->lower()->value());
    }

    public function testToUpper(): void
    {
        $s = Str::from('foo');

        $this->assertSame('FOO', $s->upper()->value());
    }

    public function testToTitle(): void
    {
        $s = Str::from('foo bar');

        $this->assertSame('Foo bar', $s->title()->value());
    }
}
