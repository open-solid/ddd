<?php

namespace Ddd\ValueObject\String;

use Ddd\Error\InvalidArgumentError;

readonly class NonEmptyString extends StringValueObject
{
    public static function from(string $value): self
    {
        if ('' === $value) {
            throw new InvalidArgumentError('String value cannot be empty.');
        }

        return new static($value);
    }
}
