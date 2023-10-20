<?php

namespace Ddd\Tests\Domain\ValueObject\String;

use Ddd\Domain\Error\InvalidArgumentError;
use Ddd\Domain\ValueObject\String\NonEmptyString;
use PHPUnit\Framework\TestCase;

class NonEmptyStringTest extends TestCase
{
    public function testEmptyError(): void
    {
        $this->expectException(InvalidArgumentError::class);
        $this->expectExceptionMessage('String cannot be empty.');

        NonEmptyString::from('');
    }

    public function testEmptyWithBlankSpacesError(): void
    {
        $this->expectException(InvalidArgumentError::class);
        $this->expectExceptionMessage('String cannot be empty.');

        NonEmptyString::from('   ');
    }

    public function testTrimString(): void
    {
        $this->assertSame('A', NonEmptyString::from(' A ')->value());
    }
}
