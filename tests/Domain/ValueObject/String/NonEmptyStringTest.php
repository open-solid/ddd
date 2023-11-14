<?php

namespace Tests\Ddd\Domain\ValueObject\String;

use Ddd\Domain\Error\InvalidArgument;
use Ddd\Domain\ValueObject\String\NonEmptyString;
use PHPUnit\Framework\TestCase;

class NonEmptyStringTest extends TestCase
{
    public function testEmptyError(): void
    {
        $this->expectException(InvalidArgument::class);
        $this->expectExceptionMessage('String cannot be empty.');

        NonEmptyString::from('');
    }

    public function testEmptyWithBlankSpacesError(): void
    {
        $this->expectException(InvalidArgument::class);
        $this->expectExceptionMessage('String cannot be empty.');

        NonEmptyString::from('   ');
    }

    public function testTrimString(): void
    {
        $this->assertSame('A', NonEmptyString::from(' A ')->value());
    }
}
