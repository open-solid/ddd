<?php

namespace Ddd\Tests\ValueObject\String;

use Ddd\Error\InvalidArgumentError;
use Ddd\Tests\ValueObject\String\Fixtures\DummyString;
use Ddd\ValueObject\String\NonEmptyString;
use PHPUnit\Framework\TestCase;

class NonEmptyStringTest extends TestCase
{
    public function testCreate(): void
    {
        $s = NonEmptyString::from('foo');

        $this->assertSame('foo', $s->value());
    }

    public function testCreateEmpty(): void
    {
        $this->expectException(InvalidArgumentError::class);
        $this->expectExceptionMessage('String value cannot be empty.');

        NonEmptyString::from('');
    }

    public function testEquals(): void
    {
        $s1 = NonEmptyString::from('foo');
        $s2 = NonEmptyString::from('foo');
        $s3 = NonEmptyString::from('bar');

        $this->assertTrue($s1->equals($s2));
        $this->assertFalse($s1->equals($s3));
    }

    public function testToString(): void
    {
        $s = NonEmptyString::from('foo');

        $this->assertSame('foo', (string) $s);
        $this->assertSame('foo', $s->toString());
    }

    public function testLength(): void
    {
        $s = NonEmptyString::from('foo');

        $this->assertSame(3, $s->length());
    }

    public function testIsEmpty(): void
    {
        $s1 = NonEmptyString::from('foo');
        $s2 = DummyString::from('');

        $this->assertFalse($s1->isEmpty());
        $this->assertTrue($s2->isEmpty());
    }

    public function testTrim(): void
    {
        $s = NonEmptyString::from(' foo ');

        $this->assertSame('foo', $s->trim()->value());
    }

    public function testToLower(): void
    {
        $s = NonEmptyString::from('FOO');

        $this->assertSame('foo', $s->toLower()->value());
    }

    public function testToUpper(): void
    {
        $s = NonEmptyString::from('foo');

        $this->assertSame('FOO', $s->toUpper()->value());
    }

    public function testToTitle(): void
    {
        $s = NonEmptyString::from('foo bar');

        $this->assertSame('Foo Bar', $s->toTitle()->value());
    }
}
